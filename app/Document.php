<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $fillable = [
    "name" ,
    "content",
    "org_admin_id",
  ];

  public function endCampaigns(){
    $campaigns = $this->campaigns;
    foreach($campaigns as $campaign){
      if(!$campaign->archived){
        $campaign->update(['archived' => true]);
        $campaign->sign_requests->each(function($req) {
          $req->update(['completed' => true]);
        });
      }
    }
  }




  // relationships
  public function org_admin() {
     return $this->belongsTo('App\User', 'org_admin_id', 'id');
  }

  public function campaigns() {
    return $this->hasMany('App\Campaign', 'document_id');
  }
}
