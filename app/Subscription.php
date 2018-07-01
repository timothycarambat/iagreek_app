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

    public static function getSubStripePlanHuman($plan){
      switch ($plan) {
        case 'iag_small':
          return "Small";
          break;
        case 'iag_med':
          return "Medium";
          break;
        case 'iag_large':
          return "Large";
          break;
        default:
        return "--";
          break;
      }
    }

    public static function getMonthlyCost($plan){
      switch ($plan) {
        case 'iag_small':
          return "$10.00";
          break;
        case 'iag_med':
          return "$20.00";
          break;
        case 'iag_large':
          return "$30.00";
          break;
        default:
        return "--";
          break;
      }
    }

    public static function getUpgradePlan($current_plan){
      switch ($current_plan) {
        case 'iag_small':
          return ['iag_med','Medium', SystemVar::where('name','org_med')->pluck('value')[0]];
          break;
        case 'iag_med':
          return ['iag_large','Large', 'Unlimited'];
          break;
        default:
          return [$current_plan, 'Same', SystemVar::where('name',$current_plan)->pluck('value')[0]];
          break;
      }
    }

    public static function getDowngradePlan($current_plan){
      switch ($current_plan) {
        case 'iag_med':
          return ['iag_small','Small', SystemVar::where('name','org_small')->pluck('value')[0]];
          break;
        case 'iag_large':
          return ['iag_med','Medium', SystemVar::where('name','org_med')->pluck('value')[0]];
          break;
        default:
          return [$current_plan, 'Same', SystemVar::where('name',$current_plan)->pluck('value')[0]];
          break;
      }
    }
}
