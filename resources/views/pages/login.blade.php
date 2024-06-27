<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @vite([
  "resources/scss/style.scss",
  "resources/js/app.js",
  ])
  <script>
    // Apply the saved color from localStorage as soon as possible
    (function() {
      const savedColor = localStorage.getItem('primaryColor');
      if (savedColor) {
        document.documentElement.style.setProperty('--bs-primary-rgb', savedColor);
      }
    })();
  </script>
  <style>
    :root {
      --bs-primary-rgb: 240, 146, 89;
    }

    #loading {
      position: fixed;
      /* Ensures it covers the entire viewport */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 999;
      /* Place it on top of other elements */
    }

    .loader {
      width: 60px;
      aspect-ratio: 2;
      --_g: no-repeat radial-gradient(circle closest-side, white 90%, #0000);
      background:
        var(--_g) 0% 50%,
        var(--_g) 50% 50%,
        var(--_g) 100% 50%;
      background-size: calc(100%/3) 50%;
      animation: l3 1s infinite linear;
      top: 64%;
      left: 50.5%;
      position: absolute;
    }

    @keyframes l3 {
      20% {
        background-position: 0% 0%, 50% 50%, 100% 50%
      }

      40% {
        background-position: 0% 100%, 50% 0%, 100% 50%
      }

      60% {
        background-position: 0% 50%, 50% 100%, 100% 0%
      }

      80% {
        background-position: 0% 50%, 50% 50%, 100% 100%
      }
    }

    @keyframes upsidedown {
      0% {
        top: 50%;
      }

      50% {
        top: 48%;
      }

      100% {
        top: 50%;
      }
    }


    .loading-svg {
      animation: upsidedown 1s infinite linear;
      position: absolute;
      top: 50%;
      left: 50%;
    }

    .form-control::placeholder {
      color: white;
    }
  </style>
</head>

<body class="bg-primary">
  <div id="loading" class="bg-primary ">

    <svg style="fill: white" class=" loading-svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="80" height="80">
      <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
      <g id="SVGRepo_iconCarrier">
        <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
      </g>
    </svg>


    <div class="loader"></div>
  </div>
  <div class="px-lg-7">
    <section class="vh-100">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-xl-10">
            <div class="card justify-content-center shadow rounded-4">
              <div class="row g-0">
                <div class="col-md-6 col-lg-6 d-none d-md-block">
                  <img src="{{ URL::asset('peti.jpg') }}" style="width: 100%; height: 100%;" class="rounded-start-4">
                </div>
                <div class="col-md-6 col-lg-6 d-flex justify-content-center align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black">
                    <form id="loginForm" method="POST" action="{{ url('/login')}}">
                      @csrf
                      <div class="d-flex align-items-center mb-3 pb-1 flex-row gap-3">
                        <svg viewBox="0 0 90 70" fill="none" xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-top" style="width:100px;height:100px;">
                          <path d="M25.6822 28.6547L72.6269 29.5504L73.0407 49.4314L25.6013 48.561L25.6822 28.6547ZM25.6822 28.6547L17.8866 22.3725L66.3629 22.8014L72.6269 29.5504" stroke="black" stroke-miterlimit="10" />
                          <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
                          <path d="M69.4307 42.4491H64.9788V49.4251H69.4307V42.4491Z" fill="black" />
                          <path d="M45.0213 65.692C40.2086 65.394 35.4128 64.7306 30.6573 63.7052C24.8641 62.3238 14.0673 56.0164 12.3408 54.2062C8.67365 50.4217 3.90308 43.9376 3.90308 35.9146C3.94113 20.5118 17.4871 8.2312 30.4147 5.89745C34.4243 5.17209 41.0403 4.04306 43.8941 3.78445L44.0796 17.7113C41.7728 17.7113 35.152 17.7113 31.5705 18.8403C24.2315 21.1678 16.512 20.3289 16.512 33.2717C16.512 46.366 25.2066 50.0495 32.0557 52.2761C35.4612 53.3799 38.4814 54.2818 39.9511 54.2881V42.1779L29.8678 42.3797L36.9118 37.6996L44.4506 33.1456L45.0213 65.692Z" fill="#F09259" stroke="black" />
                          <path d="M25.6013 48.4474L16.8972 42.5563L17.33 22.6815L25.3634 28.4024L25.6013 48.4474Z" fill="black" stroke="black" stroke-miterlimit="10" />
                          <path d="M17.8866 22.3725L25.9248 28.1186L45.8489 29.0395L45.7966 22.3725H17.8866Z" stroke="black" stroke-miterlimit="10" />
                          <path d="M43.9417 3.78445C47.8894 3.78445 50.7289 4.34582 55.8324 5.15317C64.8979 6.57865 71.5282 10.0919 76.7602 14.4125C81.7971 18.5502 86.0397 23.6024 85.9874 33.8016C85.9351 44.0007 81.2311 49.4756 76.5176 55.2469C71.7898 61.1002 64.5555 63.1375 55.6945 65.0739C51.1284 66.0641 48.132 65.856 44.9928 65.7046L43.9417 3.78445ZM48.4887 53.7268C52.8883 53.2537 53.4257 53.6637 55.9228 53.096C61.4496 51.8346 75.0812 50.6866 75.1525 36.3372C75.2144 24.5801 67.3237 20.4613 58.1678 17.9131C55.9275 17.2824 52.2366 16.0209 48.3317 15.9767L48.4887 53.7268Z" fill="#A57250" stroke="black" />
                        </svg>
                        <div class="vr"></div>
                        <span class="h1 fw-bold mb-0 text-primary">SIMGD</span>
                      </div>
                      <h5 class="fw-normal mb-3 pb-3 text-black">Please Sign In to Your Account </h5>
                      <div class="mb-4">

                        <input type="text" id="username" class="form-control text-white" style="background-color: gray" placeholder="Username" name="username">
                      </div>
                      <div class="mb-4 d-flex position-relative">
                        <input type="password" id="password" class="form-control text-white" style="background-color: gray" placeholder="Password" name="password">
                        <i class="fa-regular fa-eye-slash  position-absolute top-0 end-0 mx-1 my-2  text-white" id="togglePassword" style="font-size: 20px; cursor: pointer;"></i>
                      </div>
                      <div class="mb-4 text-center">
                        <button type="submit" class="btn w-100 text-white bg-primary" style="background-color: #2B3674">Login</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  $(window).on('load', function() {
    $("#loading").fadeOut(2000);
  });
</script>
<script>
  $(document).ready(function() {
    $('#togglePassword').on('click', function() {
      const passwordField = $('#password');
      const passwordFieldType = passwordField.attr('type');
      const icon = $(this);

      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
      } else {
        passwordField.attr('type', 'password');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
      }
    });
  });
</script>

</html>