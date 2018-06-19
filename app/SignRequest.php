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
      'additional_required',
      'additionals',
      'file_link',
    ];


    public function campaign() {
       return $this->belongsTo('App\Campaign', 'campaign_id', 'id');
    }

    public function member() {
       return $this->belongsTo('App\Member', 'member_id', 'id');
    }
}
