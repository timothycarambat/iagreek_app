<!-- Remove Document Modal -->
<div class="modal fade" id="removeDocumentModal{{$document->id}}" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header  alert-danger">
      <h4 class="modal-title text-center" style="color:#671f00">Remove {{$document->name}}?</h4>
    </div>
    <div class="modal-body">
      <p class="well" style="font-size:20px;">
        @if(!is_null($document->campaigns))
          @if( count($document->campaigns->where('archived',false)) > 0 )
            This Document is being used on <b>{{count($document->campaigns->where('archived',false))}}</b> active
             {{str_plural('campaign', count($document->campaigns->where('archived',false)) )}}.
             If you delete this document it will automatically archive those campagins.
          @else
            Are you sure you want to delete this document?
          @endif
        @else
          Are you sure you want to delete this document?
        @endif
      </p>

      <div class="row">
        <div class="col-md-12 text-center">
          <a href="/documents/remove_document/{{$document->id}}">
            <div class="col-md-4 col-md-offset-4 btn btn-wd btn-danger">
              Yes, I am sure.
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
