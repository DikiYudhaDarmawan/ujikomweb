<header class="header-area header-sticky">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="main-nav">
          <!-- Logo -->
          <a href="index.html" class="logo">
            <img src="{{asset('siswa/assets/images/logo.png')}}" alt="SnapX Photography Template">
          </a>

          <!-- Menu -->
          <ul class="nav">
            <li><a href="index.html" class="active">Home</a></li>
            <li class="has-sub">
              <a href="javascript:void(0)">Photos &amp; Videos</a>
              <ul class="sub-menu">
                <li><a href="contests.html">Contests</a></li>
                <li><a href="contest-details.html">Single Contest</a></li>
              </ul>
            </li>
            <li><a href="categories.html">Categories</a></li>
            <li><a href="users.html">Users</a></li>
          </ul>

          <!-- Logout Button -->
          <div class="border-button">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out-alt"></i> Logout
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>
          </div>

          <!-- Mobile Menu Trigger -->
          <a class='menu-trigger'>
            <span>Menu</span>
          </a>
        </nav>
      </div>
    </div>
  </div>
</header>


