<div class="card">
    <div class="header">
        <h4 class="title">Response Status</h4>
        <p class="category">{{count($campaign->sign_requests)}} Signing Requests Sent</p>
    </div>
    <div class="content">
        <div id='signRequestsLoader' class=" text-center col-xs-12">
          <i style ='color:#aeaeae' class="fas fa-circle-notch fa-spin fa-5x"></i>
        </div>
        <div id="completedSignRequests" class=" hidden ct-chart ct-minor-second"></div>
        <div class="footer">
            <div class="chart-legend">
                <i class="fa fa-circle text-info"></i> Completed
                <i class="fa fa-circle text-warning"></i> Require Additional Signatures
                <i class="fa fa-circle text-danger"></i> Unsigned
            </div>
            <hr>
            <div class="stats">
                <i class="ti-timer"></i> Campaign started {{$campaign->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
</div>
