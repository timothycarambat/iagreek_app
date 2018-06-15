<!-- New Member Modal -->
<div class="modal fade" id="newDocumentModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title text-center">Add New Document</h4>
    </div>
    <div class="modal-body">
      <p class="well">Create a new document here so you can make a <a href='/campagins'> Campaign</a> and mail it out to members!
        Assign a document title and use the editor to make the document that needs to be signed.
      </p>

      <div class="row">
        <div class="col-md-12">
          {!!Form::open(['url' => '/documents/new_document'])!!}
            <div class="col-md-12">
                <div class="form-group">
                    <label>Name</label>
                    {{Form::text('name',null,['placeholder'=>'Document Title', 'class'=>'form-control border-input','required'=>'required'])}}
                </div>
            </div>
            {{Form::submit('Create Document',['class'=>'btn btn-wd btn-info'])}}
            {!!Form::close()!!}
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
