<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\SystemVar;

class Fee extends Model
{
    public static function determineNewUserSubType($org_size){
      if( $org_size <= SystemVar::org_limit('org_small') ) {
        $ans = 'iag_small';
      }elseif ($org_size > SystemVar::org_limit('org_small') && $org_size <= SystemVar::org_limit('org_med') ) {
        $ans = 'iag_med';
      }elseif ($org_size > SystemVar::org_limit('org_med') ) {
        $ans = 'iag_large';
      }

      return $ans;
    }
}
