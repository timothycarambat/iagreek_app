$(function(){ if(window.view === "profile"){

  //upload new letterhead image
  $('input[name=letterhead]').change(function(){
      $(this).simpleUpload("/profile/upload/letterhead", {

          beforeSend: function(jqXHR, settings) { //attach csrf token manually
            jqXHR.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
          },

          start: function(file){
              //upload started
              $('#filename').html(file.name);
              $('#progress').html("");
              $('#progressBar').width(0);
          },

          progress: function(progress){
              //received progress
              $('#progress').html("Progress: " + Math.round(progress) + "%");
              $('#progressBar').width(progress + "%");
          },

          success: function(data){
              //upload successful
              let data_decoded = JSON.parse(data);
              $('#filename,#progress,#progressBar').empty();
              if( data_decoded.Status == 'Success'){
                Notify(data_decoded.Message , 'success');
                $("[data-letterhead-well]").empty();
                $("[data-letterhead-well]").append(`<img class='letterhead-img' src='${data_decoded.Data}' />`);
              }else{
                Notify(data_decoded.Message , 'danger');
              }

          },

          error: function(error){
              //upload failed
              $('#progress').html("Failure!<br>" + error.name + ": " + error.message);
          }
      });
  });

  //upload new avatar Image
  $('input[name=avatar]').change(function(){
      $(this).simpleUpload("/profile/upload/avatar", {

          beforeSend: function(jqXHR, settings) { //attach csrf token manually
            jqXHR.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
          },

          start: function(file){
              //upload started
              $('#filename').html(file.name);
              $('#progress').html("");
              $('#progressBar').width(0);
          },

          progress: function(progress){
              //received progress
              $('#progress').html("Progress: " + Math.round(progress) + "%");
              $('#progressBar').width(progress + "%");
          },

          success: function(data){
              //upload successful
              let data_decoded = JSON.parse(data);
              $('#filename,#progress,#progressBar').empty();
              if( data_decoded.Status == 'Success'){
                Notify(data_decoded.Message , 'success');
                $("[data-avatar-well]").empty();
                $("[data-avatar-well]").append(`<img class='avatar-img' src='${data_decoded.Data}' />`);
                $("#profileModal").modal('hide');
                $("img.avatar").attr('src', data_decoded.Data);
              }else{
                Notify(data_decoded.Message , 'danger');
              }

          },

          error: function(error){
              //upload failed
              $('#progress').html("Failure!<br>" + error.name + ": " + error.message);
          }
      });
  });



}}); //end windowif
