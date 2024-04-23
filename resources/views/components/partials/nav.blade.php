<nav class="navbar navbar-expand p-0 m-0">
  <div class="container-fluid p-0 m-0">
    <a class="navbar-brand" href="/">
      <div class="d-flex flex-row gap-2">
        <img src="{{ URL('assets/logo-garbantara.svg')}}" alt="Logo" class="d-inline-block align-text-top img-title">
        <h1 class="title-simgd fw-bolder text-secondary fs-sm-1 fs-3">SIMGD</h1>
      </div>
      <hr class="mt-0 mx-0 line" style="height: 7px; background-color:#A57250" />
      <p class="desc fw-bold text-start text-secondary ">Sistem Informasi Manajemen Garbantara Depo</p>
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="/notification">
            <img src="{{ URL('assets/Notification.svg')}}" alt="Notification" class="img-notif">
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ URL('assets/Profile-Navbar.svg')}}" alt="Notification" class="img-profil">
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">
                <div class="d-flex flex-row gap-2">
                  <img src="{{ URL('assets/logout-8.svg')}}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top ">
                  <span class="text">Logout</span>
                </div>
              </a></li>
            <li><a class="dropdown-item" href="/profile">
                <div class="d-flex flex-row gap-2">
                  <img src="{{ URL('assets/profile-navbar.svg')}}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top ">
                  <span class="text">Profile</span>
                </div>
              </a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="d-flex flex-row  justify-content-between mt-3 text-secondary">
  <h3 style="font-size: 1rem;">{{$msg}}</h3>

  <a href="#" class="d-flex flex-row gap-1 text-decoration-none text-reset">
    <img src="{{ URL('assets/home-icon.svg')}}" alt="" style="width: 1.08rem; height: 1.08rem;" />

    <p style="font-size: 0.8rem;">/ {{$msg}}</p>
  </a>
</div>