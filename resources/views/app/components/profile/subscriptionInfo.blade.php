<div>
    <h4 class="title">Subscription Information</h4>
</div>

<div class="row">
  <div class="col-md-12" style="margin-top:10px; font-size:18px;">
    @if( Auth::user()->onValidTrial() )
      <b>Current Subscription</b>: <b>Trial</b> ({{Auth::user()->trialDaysRemaining()}} days remaining)
    @elseif( Auth::user()->onExpiredTrial() )
      <b>Current Subscription</b>: <b> Expired Trial </b>
    @else
      <b>Current Subscription</b>: {{App\Subscription::getSubStripePlanHuman( App\Subscription::getSubStripePlan(Auth::user()->id) )}}
    @endif
  </div>

  <div class="col-md-12" style="margin-top:10px; font-size:18px;">
    @if( Auth::user()->onValidTrial() || Auth::user()->onExpiredTrial() )
      <b>Current Subscription</b>: 0.00
    @else
      <b>Monthly Cost</b>: {{App\Subscription::getMonthlyCost( App\Subscription::getSubStripePlan(Auth::user()->id) )}}
    @endif
  </div>

  <div class="col-md-6" style="margin-top:10px; font-size:18px;">
    <b>Organization Breakdown</b>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Status</th>
          <th>Size</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Registered</th>
          <th>{{Auth::user()->org_size()}}</th>
        </tr>
        <tr>
          <th>Active</th>
          @if( Auth::user()->onValidTrial() || Auth::user()->onExpiredTrial() )
            <th>{{Auth::user()->active_org_size()}} of 10</th>
          @else
            <th>{{Auth::user()->active_org_size()}} of {{App\SystemVar::org_limit( App\Subscription::getSubStripePlan(Auth::user()->id) ) }}</th>
          @endif
        </tr>
        <tr>
          <th>Inactive</th>
          <th>{{Auth::user()->inactive_org_size()}}</th>
        </tr>
        <?php
        $other_status = Auth::user()->other_status_counts();
         ?>
         @if( !is_null($other_status) )
          @foreach($other_status as $status => $count)
            <tr>
              <th>{{ucwords($status)}}</th>
              <th>{{$count}}</th>
            </tr>
          @endforeach
         @endif
      </tbody>

    </table>
  </div>
</div>

<!-- @if( !(Auth::user()->onValidTrial() || Auth::user()->onExpiredTrial()) && Auth::user()->eligableForDowngrade() )
<hr>
  <div class="row">
    <div class="col-xs-12">
      <p><b>Psst</b>, We noticed that you could actually downgrade your subscription and save some money until you add more active members.
        Click the offer below and we can handle the rest.</p>
      <a href="/profile/downgrade" class="btn btn-wd btn-primary">Change Subscription</a>
    </div>
  </div>
@endif -->
