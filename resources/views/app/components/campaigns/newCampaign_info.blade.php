<div class="col-md-12">
    <div class="form-group">
        <label>Name</label>
        {{Form::text('name',null,['placeholder'=>'Campaign Title', 'class'=>'form-control border-input','required'=>'required'])}}
    </div>

    <div class="form-group">
        <label>Document</label>
        {{Form::select('document',
        App\Document::where('org_admin_id',Auth::user()->id)->orderBy('updated_at','ASC')->pluck('name','id')
        ,"",
        ['placeholder'=>'Select A Document Template', 'class'=>'form-control border-input','required'=>'required'])}}
    </div>

    <div class="form-group">
        <label>End Campaign On</label>
        {{Form::date('expiry',
        \Carbon\Carbon::now()->addWeek(),
        ['placeholder'=>'Select Campaign Expiration Date', 'class'=>'form-control border-input','required'=>'required'])}}
    </div>
</div>
<a href="#signers" data-toggle="tab" class="btn btn-default btn-wd">Next</a>
