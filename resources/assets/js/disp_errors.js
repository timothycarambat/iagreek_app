$(function(){
  let errors = $('input[data-error]');
  errors.each(function(_,el){
    let msg = $(el).val();
    Notify(msg,'danger');
  });

  let success = $('input[data-success]');
  success.each(function(_,el){
    let msg = $(el).val();
    Notify(msg,'success');
  });

  let info = $('input[data-info]');
  info.each(function(_,el){
    let msg = $(el).val();
    Notify(msg,'info');
  });
});
