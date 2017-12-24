<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
  public function setUpdatedAt($value){;}
  public function setCreatedAt($value){;}

  public static function getStatesAll(){
  return States::orderBy('name')->get();
  }
}
