  <aside
      class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
      id="sidenav-main">
      <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
              aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
              target="_blank">
              <img src="{{asset('assets/img/logo-ct-dark.png')}}" width="26px" height="26px" class="navbar-brand-img h-100"
                  alt="main_logo">
              <span class="ms-1 font-weight-bold">Creative Tim</span>
          </a>
      </div>
      <hr class="horizontal dark mt-0">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link active" href="{{ route('home') }}">
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('datasiswa.index') }}">
                      <i class="fas fa-user"></i> <span class="ms-1">Data Siswa</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('pengumuman.index') }}">
                      <i class="fas fa-school"></i>Pengumuman
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('acara.index') }}">
                      <i class="fas fa-school"></i>absensi
                  </a>
              </li>
          </ul>
      </div>
  </aside>
