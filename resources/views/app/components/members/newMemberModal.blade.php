<!-- New Member Modal -->
<div class="modal fade" id="newMemberModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title text-center">Add New Members</h4>
    </div>
    <div class="modal-body">
      <p class="well"> <strong>Hey!</strong> We offer two easy ways to add members. You can either download our template and reupload it with all
        your members and we will update members that are already here and add the ones that aren't! You can also
        add single inputs of members!
        <br><br>Keep in mind that only active members count against your subscription count!</p>


      <ul class="nav nav-tabs">
        <li class="nav-item active">
          <a class="nav-link active" href="#addByFile" data-toggle="tab">Add by File</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#addByForm" data-toggle="tab">Add by Form</a>
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="addByFile">
          @include('app.components.members.addByFile')
        </div>

        <div class="tab-pane" id="addByForm">
          @include('app.components.members.addByForm')
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
