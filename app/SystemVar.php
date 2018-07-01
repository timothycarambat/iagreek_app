<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemVar extends Model
{
    protected $table = 'system';

    public static function org_limit($name){
      if($name == 'org_large' || $name == 'iag_large'){
        return SystemVar::where('name',$name)->pluck('value')[0];
      }
      return (integer)SystemVar::where('name',$name)->pluck('value')[0];
    }
}
