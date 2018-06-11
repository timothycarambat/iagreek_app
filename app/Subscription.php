<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    public static function getSubName($uid){ //usually gets 'main' or 'subscription'
      return Subscription::where('user_id', (integer)$uid )->pluck('name')[0];
    }

    public static function getSubStripePlan($uid){
      return Subscription::where('user_id', (integer)$uid )->pluck('stripe_plan')[0];
    }
}
