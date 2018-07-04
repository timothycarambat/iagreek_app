<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Redirect;
use Storage;

use App\Member;
use App\SignRequest;

class Campaign extends Model
{
  protected $fillable = [
    "name" ,
    "data",
    "document_id",
    "expiry",
    "archived",
    "org_admin_id",
    "dir",
  ];

  public static function createCampaign($data){
    $member_list = Campaign::getUniqueMemberList($data->select_by_tags, $data->select_by_position, $data->select_by_member);
    (array)$additionals = Campaign::compileAdditionals($data->second_signer,$data->third_signer,$data->fourth_signer);
    $dir = md5((string)\Carbon\Carbon::now().str_random(24));
    $campaign = Campaign::create([
      'name' => $data->name,
      'document_id' => $data->document,
      'org_admin_id' => Auth::user()->id,
      'expiry' => date("Y-m-d H:i:s", strtotime($data->expiry)),
      'dir' => $dir,
    ]);
    //make directory in file system
    Storage::makeDirectory("/campaigns/$dir");

    $campaign->sendMailouts($member_list);
    $campaign->createSignRequests($member_list,$additionals);
    Session::flash('success','<b>Congratulations!</b> Your Campaign was launched, the mailouts were made and now you can track its progress.');
    Redirect::to('/campaigns')->send();
  }

  public static function removeCampaign($id){
    $campaign = Campaign::where('id',(integer)$id)->get()[0];
    $campaign->sign_requests()->update(['status'=>true]);
    return $campaign->update(['archived'=>true]);
  }

  public function sendReminders(){ //generate list of members to send reminders to
    $member_list = collect([]);
    $incomplete_reqs = $this->sign_requests->where('completed',false);

    foreach($incomplete_reqs as $req){
      $member = $req->member;
      //we need to determine why member is not complete
      if( !$req->status ){ //primary member has not signed
        $member_list[] = $member;
      }elseif ($req->additional_required) {//member has signed, but additional hasnt
        $additionals = (array)json_decode($req->additionals);
        $completed = (array)array_pop($additionals);
        $additionals = array_filter(array_values($additionals));
        $diff = array_diff($additionals,$completed);
        if(count($diff) > 0){
          $next_member = Member::where('id', $diff[0])->get()[0];
          $member_list[] = $next_member;
        }
      }
    }

    $this->sendReminderMailers($member_list);
    Session::flash('success','Reminder mailers were sent out to <b>'.count($member_list).'</b> members');
    Redirect::to('/campaign/edit/'.$this->id)->send();
  }

  public function getNumericProgress(){
    $sign_reqs = $this->sign_requests()->get();
    $signed = 0;
    foreach ($sign_reqs as $req) {
      if($req->status){
        $signed++;
      }
    }
    return ($signed/ count($sign_reqs) )*100;
  }

  //This function will look through all three qualifying parameters and
  //then will filter out the duplicates
  private static function getUniqueMemberList($tags,$positions,$member_ids){
    $members = collect([]);

    if(!is_null($tags)){
      $members_with_tags = Member::where('org_admin_id', Auth::user()->id)
      ->where('status','active')
      ->withAnyTag($tags)->get();
      $members = $members->concat($members_with_tags);
    }

    if(!is_null($positions)){
      $members_with_position = Member::where('org_admin_id', Auth::user()->id)
      ->where('status','active')
      ->whereIn('position',$positions)->get();
      $members = $members->concat($members_with_position);
    }

    if(!is_null($member_ids)){
      $members_with_id = Member::where('org_admin_id', Auth::user()->id)
      ->where('status','active')
      ->whereIn('id',$member_ids)->get();
      $members = $members->concat($members_with_id);
    }
    return $members->unique();
  }

  //this function will put the signers in order. If they put a 3rd signer, but no second
  //it will auto sort the keys so a document does not hang waiting for null signer
  private static function compileAdditionals($second,$third,$fourth){
    if( empty($second) && empty($third) && empty($fourth) ){
      //no additionals set so return false
      return false;
    }else{
      $keys = ["one","two","three"];
      //filter out null values and then re-index array
      $values = array_values(array_filter([$second,$third,$fourth]));
      $additionals = [];

      foreach($keys as $i => $key){
       $additionals[$key] = isset($values[$i])? (integer)$values[$i] : null;
      }
      $additionals['completed'] = [];
      return $additionals;
    }
  }

  private static function sendMailouts($member_list){
    foreach($member_list as $member){
      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      $beautymail->send('emails.document_needs_signature',
        ['model'=>$member, 'org_name'=>Auth::user()->org_name],
        function($message) use($member) {
          $message
              ->to($member->email)
              ->subject("You've Got A Document To Sign!");
      });
      sleep(2);//have to do this so mailer doesnt block us
    }
  }

  private static function sendReminderMailers($member_list){
    foreach($member_list as $member){
      $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
      $beautymail->send('emails.signature_reminder',
        ['model'=>$member, 'org_name'=>Auth::user()->org_name],
        function($message) use($member) {
          $message
              ->to($member->email)
              ->subject("Reminder! You've Got A Document Waiting To Be Signed");
      });
      sleep(2);//have to do this so mailer doesnt block us
    }
  }

  private function createSignRequests($member_list,$additionals){
    foreach ($member_list as $member) {
      //do it this way so we can use default value for additionals
      $input = (count($additionals) > 1)?
      ['campaign_id' => $this->id,
      'member_id' => $member->id,
      'additional_required' => true,
      'additionals' => json_encode($additionals)]
      :
      ['campaign_id' => $this->id,
      'member_id' => $member->id,
      'additional_required' => false];

      SignRequest::create($input);
    }
  }

  // relationships
  public function org_admin() {
     return $this->belongsTo('App\User', 'org_admin_id', 'id');
  }

  public function document() {
    return $this->hasOne('App\Document', 'id', 'document_id');
  }

  public function members() {
    return $this->belongsToMany('App\Member');
  }

  public function sign_requests() {
    return $this->hasMany('App\SignRequest', 'campaign_id', 'id');
  }
}
