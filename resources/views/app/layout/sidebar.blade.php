<div class="sidebar" data-background-color="white" data-active-color="danger">

<!--
Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
-->

  <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/dashboard" class="simple-text">
            		<div class="row">
                	<p class="col-xs-12 text-center header"> {{config('app.name')}} </p>
                	<p class="col-xs-12 text-center header-sub"> {{Auth::user()->org_name}} </p>
            		</div>
            </a>
        </div>

        <ul class="nav">
            <li class="{{ Request::is('dashboard') ? 'active':null }}">
                <a href="/dashboard">
                    <i class="fas fa-chart-line"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="{{ Request::is('profile') ? 'active':null }}">
                <a href="/profile">
                    <i class="fas fa-user-cog"></i>
                    <p>Profile</p>
                </a>
            </li>
            <li class="{{ Request::is('members') ? 'active':null }}">
                <a href="/members">
                    <i class="fas fa-users"></i>
                    <p>Members</p>
                </a>
            </li>
            <li class="{{ (Request::is('documents') || Request::is('documents/edit/*') ) ? 'active':null }}">
                <a href="/documents">
                    <i class="fas fa-file-alt"></i>
                    <p>Documents</p>
                </a>
            </li>
            <li class="{{ Request::is('campaigns') ? 'active':null }}">
                <a href="/campaigns">
                    <i class="fas fa-bullhorn"></i>
                    <p>Campaigns</p>
                </a>
            </li>
            <li class="{{ Request::is('archive') ? 'active':null }}">
                <a href="/archive">
                    <i class="fas fa-archive"></i>
                    <p>Archive</p>
                </a>
            </li>
        </ul>
  </div>
</div>
