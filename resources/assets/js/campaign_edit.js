$(function(){ if(window.view === "campaign_edit"){
  var campaignId = window.location.pathname.split('/').reverse()[0];
  loadResponseChart(campaignId);




}}); //end windowif

function loadResponseChart(id){
  $.ajax({
    url: `/campaign/response_status/${id}`,
    type: 'GET',
    beforeSend: function(jqXHR, settings) { //attach csrf token manually
      jqXHR.setRequestHeader('X-CSRF-TOKEN', window.csrf_token);
    },
    success: function(res){
      let results = JSON.parse(res);
      let data = {series: results.data};
      let sum = function(a, b) { return a + b };

      new Chartist.Pie('#completedSignRequests', data, {
        labelInterpolationFnc: function(value) {
          return value > 0? Math.round(value / data.series.reduce(sum) * 100) + '%' : null;
        }
      });
      $('#completedSignRequests').removeClass('hidden');
      $('#signRequestsLoader').remove();
    }
  })
}
