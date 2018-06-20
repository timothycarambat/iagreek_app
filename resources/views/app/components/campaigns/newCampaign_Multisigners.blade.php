<div class="col-md-12">
    <div class="well" style="margin-top:5px">
      If you need someone else to sign your document after the primary signer is done - tell us so here and we can make sure it happens. This selection
      is done by specifiying the member. The order in which you list them is the order they will be fulfilled! <br>List up to <b>3</b> other signers!
      <br>If you dont need this just leave them as they are!
    </div>

    <div class="form-group">
        <label>2<sup>nd</sup> Signer:</label>
        {{Form::select('second_signer',
        App\Member::where('org_admin_id',Auth::user()->id)->where('status','active')->pluck('name','id')
        ,"",
        ['placeholder'=>'Select Secondary Signature', 'class'=>'form-control border-input'])}}
    </div>

    <div class="form-group">
        <label>3<sup>rd</sup> Signer:</label>
        {{Form::select('third_signer',
        App\Member::where('org_admin_id',Auth::user()->id)->where('status','active')->pluck('name','id')
        ,"",
        ['placeholder'=>'Select Secondary Signature', 'class'=>'form-control border-input'])}}
    </div>

    <div class="form-group">
        <label>4<sup>th</sup> Signer:</label>
        {{Form::select('fourth_signer',
        App\Member::where('org_admin_id',Auth::user()->id)->where('status','active')->pluck('name','id')
        ,"",
        ['placeholder'=>'Select Secondary Signature', 'class'=>'form-control border-input'])}}
    </div>

</div>
