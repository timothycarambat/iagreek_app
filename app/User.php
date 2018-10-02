<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Storage;
use Carbon\Carbon;

use App\Subscription;
use App\SystemVar;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      "email" ,
      "password",
      "org_name",
      "name",
      "phone",
      "address",
      "city",
      "state",
      "zip",
      "website",
      "org_type",
      "billing_name",
      "billing_phone",
      "billing_address",
      "billing_city",
      "billing_state",
      "billing_zip",
      "org_size",
      "avatar",
    ];

    protected $dates = [
      'trial_ends_at',
      'created_at',
      'updated_at',
      'deleted_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot() {
      parent::boot();
      self::creating(function($model) {
        $model->avatar = User::makeIdenticon($model->org_name);
      });
    }

    public static function formatPhone($phone){
      return '('.substr($phone, 0, 3).') '.substr($phone, 3, 3).'-'.substr($phone,6);
    }

    public static function cancelAccount($user_id){
      $user = User::where('id',$user_id)->get()[0];
      $sub_name = Subscription::getSubName($user_id);
      return $user->subscription($sub_name)->cancelNow();
    }

    public function org_size() {
      return $this->members()->count();
    }

    public function active_org_size() {
      return $this->members()->where('status','active')->count();
    }

    public function inactive_org_size() {
      return $this->members()->where('status','inactive')->count();
    }

    public function other_status_counts() {
      $other_statuses = $this->members()->where('status','!=','active')->where('status','!=','inactive')->pluck('status');
      if( !empty($other_statuses) ){
        $res = [];
        foreach ($other_statuses as $status) {
          $res[$status] = $this->members()->where('status',$status)->count();
        }
        return $res;
      }else {
        return null;
      }
    }

    public function getPlanMax() {
      $plan = Subscription::getSubStripePlan($this->id);
      if( $plan === 'iag_large' ){
        return 'Unlimited';
      }else{
        return SystemVar::where('name', $plan)->pluck('value')[0];
      }
    }

    public function eligableForDowngrade(){
      $plan = Subscription::getSubStripePlan($this->id);
      //if already on smallest plan you can't downgrade
      if($plan === 'iag_small'){return false;}
      $org_map = [
        'iag_small' => SystemVar::org_limit('iag_small'),
        'iag_med' => SystemVar::org_limit('iag_med')
      ];

      if( $plan === 'iag_med' && $this->active_org_size() < $org_map['iag_small'] ){
        //medium user can downgrade to small
        return true;
      }elseif ($plan === 'iag_large' && $this->active_org_size() < $org_map['iag_med'] ) {
        //large user can downgrade to medium
        return true;
      }else {
        return false;
      }
    }

    public function withinLimit($limit_key, $count){
      return ($count < (int)SystemVar::where('name', $limit_key)->pluck('value')[0]);
    }

    public function isPayingCustomer(){
       if($this->onValidTrial() || $this->onExpiredTrial()){ return false;}
       return $this->subscribed( Subscription::getSubName($this->id ));
    }

    public function onValidTrial(){
      return ($this->onGenericTrial() && $this->trialDaysRemaining() >= 0);
    }

    public function onExpiredTrial(){
      return (!$this->onGenericTrial() && !$this->trialDaysRemaining() >= 0 && is_null($this->stripe_id));
    }

    public function trialDaysRemaining(){
      return Carbon::parse($this->trial_ends_at)->diffInDays(Carbon::now());
    }

    # make identicon for new users stored in avatars/
    private static function makeIdenticon($org_name){
      $icon = new \Jdenticon\Identicon(array(
          'size' => 200,
          'value' => $org_name
      ));
      $img_name = str_random(12).".png";
      Storage::disk($_ENV['FILESYSTEM_DRIVER'])->put("avatars/".$img_name, file_get_contents($icon->getImageDataUri('png')) );
      return Storage::url("avatars/$img_name");
    }


    //realationships
    public function members() {
       return $this->hasMany('App\Member', 'org_admin_id','id');
    }

    public function documents() {
       return $this->hasMany('App\Document', 'org_admin_id','id');
    }

    public function campaigns() {
       return $this->hasMany('App\Campaign', 'org_admin_id','id');
    }
}
