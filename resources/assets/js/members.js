$(function(){ if(window.view === "members"){
  $('table').tablesorter();

  $('th').click(function(e){
    setTimeout(function(){evalHeaders()},100);
  })
  initRosterSubmission();
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
  $('input[name=roster]').change(function(){
      $(this).simpleUpload("/members/upload/roster", {

          beforeSend: function(jqXHR, settings) { //attach csrf token manually
            jqXHR.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
          },

          start: function(file){
              console.log(file.name)
          },

          progress: function(progress){
              console.log(progress);
          },

          success: function(data){
              //upload successful
              let data_decoded = JSON.parse(data);
              if( data_decoded.Status == 'Success'){
                Notify(data_decoded.Message , 'success');
              }else{
                Notify(data_decoded.Message , 'info');
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
