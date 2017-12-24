<!-- Header -->
  <header id="header" class="alt">
    <h1><a href="/">IAGREEK</a></h1>
    <nav id="nav">
      <ul>
        <li class="special">
          <a href="#menu" class="menuToggle"><span>Menu</span></a>
          <div id="menu">
            <ul>
              <li><a href="/">Home</a></li>
              <li><a href="/about">About</a></li>
                @if( !Auth::check() )
                  <li><a href="/register">Sign Up</a></li>
                  <li><a href="/login">Log In</a></li>
                @else
                  <li><a href="/dashboard"><b>{{Auth::user()->org_name}}</b> Dashboard</a></li>
                  <li><a href="/logout">Logout</a></li>
                @endif
            </ul>
          </div>
        </li>
      </ul>
    </nav>
  </header>
