<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemVar extends Model
{
    protected $table = 'system';

    public static function org_limit($name){
      return (integer)SystemVar::where('name',$name)->pluck('value')[0];
    }
}
