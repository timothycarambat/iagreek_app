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
      'addtionals',
      'file_link',
    ];
}
