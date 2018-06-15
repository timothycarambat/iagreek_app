<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subscription;
use App\Fee;

use Auth;

class Member extends Model
{
    use \Conner\Tagging\Taggable;
    protected $table = "members";
    protected $fillable = [
      "email" ,
      "password",
      "name",
      "position",
      "status",
      "org_admin_id",
    ];

    public static function boot() {
      parent::boot();
      self::creating(function($model) {
        //send email when creating new Member!
        Member::sendSignUpEmail($model);
      });
    }

    public static function processRoster($roster) { //where $roster is a file ref
      /** Load $inputFileName to a Spreadsheet Object  **/
      $spreadsheet =  \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($roster->path());
      $spreadsheet->setLoadSheetsOnly("Member Roster");
      $spreadsheet->setReadDataOnly(true);
      $spreadsheet = $spreadsheet->load($roster->path());
      $header = true; //set for header row
      $roster = [];
      foreach ($spreadsheet->setActiveSheetIndex(0)->getRowIterator() as $row) {
          if($header){$header = false;continue;}
          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(false);
          $rowdata = [];
          $column = 0;
          $column_names = ['name','email','position','status','tags'];
          foreach ($cellIterator as $cell) {
              if (!is_null($cell)) {
                  $value = $cell->getCalculatedValue();
                  $rowdata[ $column_names[$column] ] = $value;
              }
              $column++;
          }
          $roster[] = $rowdata;
      }
      return $roster;
    }

    public static function updateOrCreateMembers($roster) { //$roster is an array of arrays
      $res = [
        'Status'=>null,
        'Message'=>null
      ];

      //get member count who appear in Roster
      $roster_emails = array_column($roster, 'email');
      $member_update_count = Member::whereIn('email', $roster_emails)->count();
      $member_new_count = count($roster_emails) - $member_update_count;

      $estimate_new_org_size = Auth::user()->active_org_size() + $member_new_count;
      // compare the users current stripe plan name with the plan name determined by organization size.
      // if they are equal -OK. If they are not then the user needs to upgrade their plan.
      if( Subscription::getSubStripePlan(Auth::user()->id) != Fee::determineNewUserSubType($estimate_new_org_size) ){
        $res = [
          'Status'=>'Failure',
          'Message'=>"<strong>You're Growing!</strong> Looks like to add these new members in youre gonna need to set some existing members inactive or
           <a style='color:#351515' href='/profile?upgrade=true'>upgrade your subscription!</a>"
        ];
        return $res;
      }

      foreach($roster as $member){
        if( empty(trim($member['tags'])) ){
          // if tag field empty then empty the tags instead of parsing
          $tags = [];
        }else{
          $tags = explode(',',$member['tags']);
        }

        // assign writable fields
        $member = Member::updateOrCreate(['email' => $member['email'] ],
        ['name' => $member['name'],
        'password'=> bcrypt(str_random(24)),
        'position' => ucfirst($member['position']),
        'status' => strtolower($member['status']),
        'org_admin_id' => Auth::user()->id
        ]);
        // retag member if necessary
        $member->retag($tags);
      }

      //make smart text for updated and created members
      if( $member_update_count > 0 && $member_new_count > 0){
        $text = "update $member_update_count members and add $member_new_count members";
      }elseif ( $member_update_count > 0) {
        $text = "update $member_update_count members";
      }else{
        $text = "add $member_new_count members";
      }

      $res = [
        'Status'=>'Success',
        'Message'=>"<strong>You're Good!</strong> The list was used to $text to your organization. Refresh to view changes."
      ];
      return $res;
    }

    public static function addNewMember($new_member){
      return Member::create($new_member);
    }

    public static function sendSignUpEmail($model){
      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      $beautymail->send('emails.member_signup',
        ['model'=>$model, 'org_name'=>Auth::user()->org_name],
        function($message) use($model) {
          $message
              ->to($model->email)
              ->subject("You've been invited to sign into IAGREEK!");
      });
    }


    public function org_admin() {
       return $this->belongsTo('App\User', 'org_admin_id', 'id');
    }

    public function campaigns() {
       return $this->belongsToMany('App\Campaign');
    }

}
