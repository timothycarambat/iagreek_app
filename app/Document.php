<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

use App\PDFGenerator;

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

  public function generatePreview(){
    return PDFGenerator::makePDF($this);
  }

  public function formatDocumentText(){
    $user = Auth::user();
    $content = htmlspecialchars_decode($this->content);
    $content = preg_replace("<<%NAME%>>", ucwords($user->name), $content);
    $content = preg_replace("<<%DATE%>>", \Carbon\Carbon::now()->toFormattedDateString(), $content);
    return $content;
}




  // relationships
  public function org_admin() {
     return $this->belongsTo('App\User', 'org_admin_id', 'id');
  }

  public function campaigns() {
    return $this->hasMany('App\Campaign', 'document_id');
  }
}
