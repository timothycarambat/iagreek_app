<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Storage;

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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot() {
      parent::boot();
      self::creating(function($model) {
        $model->avatar = User::makeIdenticon($model->org_name);
      });
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
}
