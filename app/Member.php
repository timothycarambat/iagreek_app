<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "members";
    protected $fillable = [
      "email" ,
      "password",
      "name",
      "position",
      "status",
      "org_admin_id",
    ];


    public function org_admin() {
       return $this->belongsTo('App\User', 'org_admin_id', 'id');
    }
}
