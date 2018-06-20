<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignRequest extends Model
{
    protected $table = 'sign_requests';
    protected $fillable = [
      'campaign_id',
      'member_id',
      'status',
      'completed',
      'additional_required',
      'additionals',
      'file_link',
    ];

    public function getAdditionalProgress(){
      $additonals = (array)json_decode($this->additionals);
      $additonals = array_values($additonals);
      $completed = (array)array_pop($additonals);
      return count($completed)." of ".count($additonals);
    }

    public function campaign() {
       return $this->belongsTo('App\Campaign', 'campaign_id', 'id');
    }

    public function member() {
       return $this->belongsTo('App\Member', 'member_id', 'id');
    }
}
