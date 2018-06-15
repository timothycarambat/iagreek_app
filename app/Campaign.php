<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


  // relationships
  public function org_admin() {
     return $this->belongsTo('App\User', 'org_admin_id', 'id');
  }

  public function members() {
    return $this->belongsToMany('App\Member');
  }
}
