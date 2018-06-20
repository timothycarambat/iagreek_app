<div class="col-md-12">
    <div class="well" style="margin-top:5px">
      Here is where you will select <b>who</b> the document goes to. This is the main signer of the document. Select by Tag, Position, or by Member...or all three!
      <br><br>If you need multiple signatures on single document
      for it to be 'complete' - thats the next step!
    </div>
    <div class="form-group">
        <label>Everyone With the Tag... (can select multiple)</label>
        {{Form::select('select_by_tags',
        App\Member::where('org_admin_id',Auth::user()->id)->first()->existingTags()->pluck('name','slug')
        ,"",
        ['placeholder'=>'Select By Tags',
        'class'=>'form-control border-input',
        'multiple'=>'multiple',
        'name'=>'select_by_tags[]'
        ])}}
    </div>

    <div class="form-group">
        <label>Everyone In the Position... (can select multiple)</label>
        {{Form::select('select_by_position',
        App\Member::getOrgPositions(Auth::user()->id)
        ,"",
        ['placeholder'=>'Select By Position',
        'class'=>'form-control border-input',
        'multiple'=>'multiple',
        'name'=>'select_by_position[]'
        ])}}
    </div>

    <div class="form-group">
        <label>Specific Members (can select multiple)</label>
        {{Form::select('select_by_member',
        App\Member::where('org_admin_id',Auth::user()->id)->where('status','active')->pluck('name','id')
        ,"",
        ['placeholder'=>'Select By Member',
        'class'=>'form-control border-input',
        'multiple'=>'multiple',
        'name'=>'select_by_member[]'
        ])}}
    </div>
</div>
<a href="#Multisigners" data-toggle="tab" class="btn btn-default btn-wd">I Need Approval Signatures</a>
