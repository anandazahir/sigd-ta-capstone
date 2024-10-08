@php
$url = request()->path();
$segments = explode('/', $url);

// List of roles that should be hidden from the breadcrumb
$roles = ['direktur', 'inventory', 'surveyin', 'repair', 'tally', 'kasir', 'mops'];

// Remove the first segment if it is a role
if (in_array($segments[0], $roles)) {
array_shift($segments);
}

// Remove 'dashboard' segment
$segments = array_filter($segments, function($segment) {
return $segment !== 'dashboard';
});
$route = '';
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<style>
  .fa-house:hover {
    color: gray;
  }

  .fa-house {
    color: rgb(var(--bs-primary-rgb));
  }

  .hovertext {
    color: var(--bs-primary);
    text-decoration: none;
  }

  .hovertext:hover {
    color: gray;
  }
</style>
<nav class="navbar navbar-expand p-0 m-0">
  <div class="container-fluid p-0 m-0">
    <a class="navbar-brand" href="{{route($cleaned.'.dashboard')}}">
      <div class="d-flex flex-row gap-2">
        <svg viewBox="0 0 90 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-top img-title">
          <path d="M25.6822 28.6547L72.6269 29.5504L73.0407 49.4314L25.6013 48.561L25.6822 28.6547ZM25.6822 28.6547L17.8866 22.3725L66.3629 22.8014L72.6269 29.5504" stroke="black" stroke-miterlimit="10" />
          <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
          <path d="M69.4307 42.4491H64.9788V49.4251H69.4307V42.4491Z" fill="black" />
          <path d="M45.0213 65.692C40.2086 65.394 35.4128 64.7306 30.6573 63.7052C24.8641 62.3238 14.0673 56.0164 12.3408 54.2062C8.67365 50.4217 3.90308 43.9376 3.90308 35.9146C3.94113 20.5118 17.4871 8.2312 30.4147 5.89745C34.4243 5.17209 41.0403 4.04306 43.8941 3.78445L44.0796 17.7113C41.7728 17.7113 35.152 17.7113 31.5705 18.8403C24.2315 21.1678 16.512 20.3289 16.512 33.2717C16.512 46.366 25.2066 50.0495 32.0557 52.2761C35.4612 53.3799 38.4814 54.2818 39.9511 54.2881V42.1779L29.8678 42.3797L36.9118 37.6996L44.4506 33.1456L45.0213 65.692Z" style="fill:rgb(var(--bs-primary-rgb))" stroke="black" />
          <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
          <path d="M17.8866 22.3725L25.9248 28.1186L45.8489 29.0395L45.7966 22.3725H17.8866Z" stroke="black" stroke-miterlimit="10" />
          <path d="M43.9417 3.78445C47.8894 3.78445 50.7289 4.34582 55.8324 5.15317C64.8979 6.57865 71.5282 10.0919 76.7602 14.4125C81.7971 18.5502 86.0397 23.6024 85.9874 33.8016C85.9351 44.0007 81.2311 49.4756 76.5176 55.2469C71.7898 61.1002 64.5555 63.1375 55.6945 65.0739C51.1284 66.0641 48.132 65.856 44.9928 65.7046L43.9417 3.78445ZM48.4887 53.7268C52.8883 53.2537 53.4257 53.6637 55.9228 53.096C61.4496 51.8346 75.0812 50.6866 75.1525 36.3372C75.2144 24.5801 67.3237 20.4613 58.1678 17.9131C55.9275 17.2824 52.2366 16.0209 48.3317 15.9767L48.4887 53.7268Z" fill="black" stroke="black" />
        </svg>
        <h1 class="title-simgd fw-bolder text-primary fs-sm-1 fs-3">SIMGD</h1>
      </div>
      <hr class="mt-0 mx-0 line" style="height: 7px; background-color:rgb(var(--bs-primary-rgb))" />
      <p class="desc fw-bold text-start text-primary ">Sistem Informasi Manajemen Garbantara Depo</p>
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item position-relative p-0">
          <a href="/{{$cleaned}}/notifikasi">
            <i class="fa-solid fa-bell text-primary img-notif my-2 mx-3">
            </i>
            <span class=" badge rounded-pill text-bg-danger text-white" style="position:absolute; bottom:2.1rem; left:2.5rem;" id="text-notif">{{auth()->user()->notifikasi->count()}}</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            @if (auth()->user()->foto)
            <img src="{{URL::asset('storage/'.auth()->user()->foto)}}" alt="" class="rounded-circle" width="41" height="41">
            @else
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="41" height="41" class="rounded-circle">
              <title>user-solid-svg</title>
              <style>
                .s1 {
                  fill: #ffffff
                }
              </style>
              <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
              <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
            </svg>
            @endif
          </a>
          <ul class="dropdown-menu">

            <li><a class="dropdown-item" href="/{{$cleaned}}/profile">
                <div class="d-flex flex-row gap-2">
                  @if (auth()->user()->foto)
                  <img src="{{URL::asset('storage/'.auth()->user()->foto)}}" alt="" class="rounded-circle" width="27" height="27">
                  @else
                  <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="27" height="27" class="rounded-circle">
                    <title>user-solid-svg</title>
                    <style>
                      .s1 {
                        fill: #ffffff
                      }
                    </style>
                    <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
                    <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                  </svg>
                  @endif
                  <span class="text">Profile</span>
                </div>
              </a></li>


            <li>
              <form action="{{url('/logout')}}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item" href="/login">
                  <div class="d-flex flex-row gap-2">
                    <i class="fa-solid fa-power-off text-danger" style="font-size:27px"></i>
                    <span class="text">Logout</span>
                  </div>
                </button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="d-flex flex-row  justify-content-between mt-3 mb-2 text-primary">
  <h3  style="font-size: 1.7rem; font-weight:650;">{{$msg}}</h3>
  <div class="d-flex align-items-center">
    <a href="{{route($cleaned.'.dashboard')}}" style="height: fit-content; ">
      <i class="fa-solid fa-house mx-1"></i>
    </a>
    @php
    $role = auth()->user()->getRoleNames();
    $cleaned = str_replace(['[', ']', '"'], '', $role);
    @endphp

    @if(count($segments) > 0)
    @foreach($segments as $key => $segment)
    @if($key == 0)
    <span class="text-primary">/</span>
    @endif
    <a class="hovertext" href="{{ url($cleaned . '/' . implode('/', array_slice($segments, 0, $key + 1))) }}">{{ ucfirst(str_replace("-", " ", $segment)) }}</a>
    @if($key < count($segments) - 1) <span class="text-primary">/</span>
      @endif
      @endforeach
      @endif
  </div>

</div>
{{--
@push('page-script')
<script>
  const textnotif = $('#text-notif').text();
  let numtextnotif = parseInt(textnotif);
  $(document).on('click', '.button-url', function(e) {
    e.preventDefault();
    if (numtextnotif) {
      numtextnotif--;
      $('#text-notif').text(numtextnotif);
    }
  });
</script>
@endpush()
--}}