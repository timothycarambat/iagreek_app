<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    public static function determineNewUserSubType($org_size){
      if( $org_size >=1 && $org_size <= 100){
        $ans = 'iag_small';
      }elseif ($org_size >=101 && $org_size <= 200) {
        $ans = 'iag_med';
      }elseif ($org_size >=201) {
        $ans = 'iag_large';
      }

      return $ans;
    }
}
