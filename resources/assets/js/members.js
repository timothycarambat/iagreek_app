$(function(){ if(window.view === "members"){
  $('table').tablesorter();

  $('th').click(function(e){
    setTimeout(function(){evalHeaders()},100);
  })
  initRosterSubmission();

  $('[data-remove-member]').click(function(e){
    let member = getMemberDetails($(e.target));
    makeRemoveModal(member);
  })

  $('[data-edit-member]').click(function(e){
    let member = getMemberDetails($(e.target));
    makeEditModal(member);
  })
}}); //end windowif


function evalHeaders(){
  let unsorted = $('.tablesorter-headerUnSorted');
  let ascSort = $('.tablesorter-headerAsc');
  let dscSort = $('.tablesorter-headerDesc');
  unsorted.each(function(i,el){
    $(el).children().eq(0).children().eq(0).addClass('fa-sort').removeClass('fa-sort-up fa-sort-down');
  })

  ascSort.each(function(i,el){
    $(el).children().eq(0).children().eq(0).addClass('fa-sort-up').removeClass('fa-sort fa-sort-down');
  })

  dscSort.each(function(i,el){
    $(el).children().eq(0).children().eq(0).addClass('fa-sort-down').removeClass('fa-sort fa-sort-up');
  })

}

function initRosterSubmission(){
  //upload new letterhead image
  $('input[name=roster]').change(function(e){
      $(this).simpleUpload("/members/upload/roster", {

          beforeSend: function(jqXHR, settings) { //attach csrf token manually
            jqXHR.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
          },

          start: function(file){
              $('.upload-btn').html(`Uploading Roster <i class='fas fa-spinner fa-spin'></i>`);
          },

          progress: function(progress){
              // console.log(progress);
          },

          success: function(data){
              //upload successful
              let data_decoded = JSON.parse(data);
              if( data_decoded.Status == 'Success'){
                Notify(data_decoded.Message , 'success');
                $('.upload-btn').html(`Uploading Roster <i class='fas fa-check'></i>`);
              }else{
                Notify(data_decoded.Message , 'info');
                $('.upload-btn').html(`Uploading Roster <i class='fas fa-times'></i>`);
              }
          },

          error: function(error){
              //upload failed
              console.log(error.name +" - "+ error.message);
              $('#progress').html("Failure!<br>" + error.name + ": " + error.message);
          }
      });
  });
}

function getMemberDetails($target){
  let id = $target.data('member');
  let name = $target.parent().siblings().eq(0).text();
  let email = $target.parent().siblings().eq(1).text();
  let status = $target.parent().siblings().eq(2).text();
  let position = $target.parent().siblings().eq(3).text();
  let tags = $target.parent().siblings().eq(4).text();

  return {
    id: id,
    name: name,
    email: email,
    status: status,
    position: position,
    tags: tags,
  }
}

function makeRemoveModal(member){
  let modal = `
  <div class="modal fade" id="removeMember${member.id}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Remove ${member.name}?</h4>
        </div>
        <div class="modal-body">
          <b> Please be aware that once you cant undo this action! If you sign them back up they will have to
          create a password again - as if they had never had an account in the first place!</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick='removeMember(${member.id})' class="btn btn-danger">Remove Member</button>
        </div>
      </div>
    </div>
  </div>
  `
  $('body').append(modal);
  $(`#removeMember${member.id}`).modal('show');
}

function makeEditModal(member){
  let modal = `
  <div class="modal fade" id="editMember${member.id}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center">Editing ${member.name}?</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class='col-md-12' action='/members/editMember' method='POST'>
              <input type="hidden" name="_token" value="${window.csrf_token}">
              <input type="hidden" name="id" value="${member.id}">
              <div class="col-md-12">
                  <div class="form-group">
                      <label>Name</label>
                      <input class='form-control' type='text' name='name' placeholder='Member Name' value='${member.name}' />
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                      <label>Email</label>
                      <input class='form-control' type='email' disabled placeholder='Member Email' value='${member.email}' />
                      <p><i>You cant edit this field, but you can remove and re-add them with the correct email!</i></p>
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                      <label>Position</label>
                      <input class='form-control' type='text' name='position' placeholder='Member Name' value='${member.position}' />
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                      <label>Status</label>
                      <input class='form-control' type='text' name='status' placeholder='Member Name' value='${member.status}' />
                  </div>
              </div>

              <button type="submit" class="btn btn-info">Submit Edits</button>

            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  `
  $('body').append(modal);
  $(`#editMember${member.id}`).modal('show');
}

window.removeMember = function(id){
  //remove generated modal
  $(`#removeMember${id}`).modal('hide').remove();

  $.ajax({
    url: "/members/removeMember",
    type: "POST",
    data:{id: id},
    beforeSend: function(request) {
      request.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
    },
    success: function(res){
      let result = JSON.parse(res);
      if(result.Status === 'Success'){
        Notify(result.Message, 'success');
        $(`[data-remove-member][data-member=${id}]`).parents().closest('tr').remove();
      }else{
        Notify( result.Message, 'failure');
      }
    }
  })
}
