<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Redirect;

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
  ];

  public static function createCampaign($data){
    $member_list = Campaign::getUniqueMemberList($data->select_by_tags, $data->select_by_position, $data->select_by_member);
    $additionals = Campaign::compileAdditionals($data->second_signer,$data->third_signer,$data->fourth_signer);
    $campaign = Campaign::create([
      'name' => $data->name,
      'document_id' => $data->document,
      'org_admin_id' => Auth::user()->id,
      'expiry' => date("Y-m-d H:i:s", strtotime($data->expiry)),
    ]);

    // $campaign->sendMailouts($member_list);
    $campaign->createSignRequests($member_list,$additionals);
    Session::flash('success','<b>Congratulations!</b> Your Campaign was launched, the mailouts were made and now you can track its progress.');
    Redirect::to('/campaigns')->send();
  }

  //This function will look through all three qualifying parameters and
  //then will filter out the duplicates
  private static function getUniqueMemberList($tags,$positions,$member_ids){
    $members = collect([]);

    if(!is_null($tags)){
      $members_with_tags = Member::where('org_admin_id', Auth::user()->id)
      ->withAnyTag($tags)->get();
      $members = $members->concat($members_with_tags);
    }

    if(!is_null($positions)){
      $members_with_position = Member::where('org_admin_id', Auth::user()->id)
      ->whereIn('position',$positions)->get();
      $members = $members->concat($members_with_position);
    }

    if(!is_null($member_ids)){
      $members_with_id = Member::where('org_admin_id', Auth::user()->id)
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

  public function members() {
    return $this->belongsToMany('App\Member');
  }

  public function sign_requests() {
    return $this->hasMany('App\SignRequest', 'campaign_id', 'id');
  }
}
