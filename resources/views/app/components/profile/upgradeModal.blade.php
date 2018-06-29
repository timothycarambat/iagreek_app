<div style='display:block; overflow-y:scroll' class="modal fade in" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header alert alert-success">
        <h5 class="modal-title text-center " ><b>Upgrade Account?</b></h5>
      </div>
      <div class="modal-body" style="font-size:20px;">
				Hey there,
        <?php
        $upgraded_plan = Auth::user()->getUpgradePlan();
        ?>

				Currently your Subscription plan only allows up to {{Auth::user()->getPlanMax()}} <b>Active</b> members. In order to have more active members you can mail and manage
        You will need to upgrade your account to the <b>{{$upgraded_plan[1]}}</b> Subscription; which allows <b>{{$upgraded_plan[2]}}</b> Members.
				<br><br>
        Any pro-rated billing for your upgrade will be handled automatically! We like to keep it simple.
        <br><br>
        Also! Keep an eye out on this page on the "Subscription" tab to see if you're ever eligible to downgrade your Subscription and save some money!
        <br><br>
				Best,
				<br>
				IAGREEK Support Team
				{!!Form::open(['url'=>'/user/'.Auth::user()->id.'/upgrade'])!!}
      </div>
      <div class="modal-footer">
        <a href="/profile">
          <div class="btn btn-deafult btn-wd" data-dismiss="modal">Close</div>
        </a>
        <button type="submit" class="btn btn-success btn-wd">Upgrade Account</button>
      </div>
			{!!Form::close()!!}
    </div>
  </div>
</div>
