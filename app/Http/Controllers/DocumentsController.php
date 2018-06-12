<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Redirect;

use App\Document;

class DocumentsController extends Controller
{
    public static function newDocument(Request $request){
      Document::create([
        'name' => ucwords($request->name),
        'content' => '',
        'org_admin_id' => Auth::user()->id,
      ]);

      Session::flash('success',"Document <b>$request->name</b> created!");
      Redirect::to('/documents')->send();
    }

    public static function removeDocument($doc_id){
      $document = Document::find($doc_id);
      // only delete documents user owns
      if( $document->org_admin->id === Auth::user()->id ){
        $document->delete();
        Session::flash('success',"Document deleted!");
      }else{
        Session::flash('failure',"This Document could not be deleted.");
      }
      Redirect::to('/documents')->send();
    }
}
