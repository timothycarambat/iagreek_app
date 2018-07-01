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
                <!-- <li>
                  <a href="#"data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <p class="notification">0</p>
                  			<p>Notifications</p>
                  </a>
                </li> -->


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
