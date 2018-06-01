$(function(){ if(window.view === "members"){
  $('table').tablesorter();

  $('th').click(function(e){
    setTimeout(function(){evalHeaders()},100);
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
