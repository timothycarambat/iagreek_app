<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="{{Request::is()}}">{{$title}}</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if( Auth::user()->onValidTrial() )
                  <li>
                    <a href="#"data-toggle="dropdown">
                          <i class="fas fa-clock"></i>
                          <p class="notification">{{Auth::user()->trialDaysRemaining()}}</p>
                    			<p>Trial Days Remaining</p>
                    </a>
                  </li>
                @elseif( Auth::user()->onExpiredTrial() )
                  <li>
                    <a href="/profile">
                          <i class="fas fa-clock"></i>
                          <p class="notification">{{Auth::user()->trialDaysRemaining()}}</p>
                          <p>Trial Days Remaining</p>
                    </a>
                  </li>
                @endif


                <li  class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                        <p>Hello, {{Auth::user()->name}}</p>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>
