<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    public static function getSubName($uid){
      return Subscription::where('user_id', (integer)$uid )->pluck('name')[0];
    }
}
