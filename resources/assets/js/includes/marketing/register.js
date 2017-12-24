if( window.view === 'register'){
  $(function(){

    $('#org_size').on('change',function(e){
      console.log('running');
      let size = +$(e.target).val();
      $('.small-plan,.med-plan,.lg-plan').removeClass('active');

        if(size >= 1 && size <= 100){
          $('.small-plan').addClass('active');
        }else if(size >= 101 && size <= 200){
          $('.med-plan').addClass('active');
        }else if(size >= 201){
          $('.lg-plan').addClass('active');
        }else{
          $(e.target).val(1);
          $('.small-plan').addClass('active');
        }
    });
    $('#org_size').change();




  })
}
