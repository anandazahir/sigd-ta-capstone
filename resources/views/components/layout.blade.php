<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? " "}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.8.2/countUp.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Apply the saved color from localStorage as soon as possible
        (function() {
            const savedColor = localStorage.getItem('primaryColor');
            const savedRGBColor = localStorage.getItem('primaryRGBColor');
            if (savedColor) {
                document.documentElement.style.setProperty('--bs-primary-rgb', savedColor);
                document.documentElement.style.setProperty('--bs-primary', savedRGBColor);
            }
        })();
    </script>
    </script>
    @vite([
    "resources/scss/style.scss",
    "resources/js/app.js",
    ])
    <style>
        :root {
            --bs-primary: #f09259;
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
    </style>
</head>

<body>
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
    <div class="px-lg-7" id="content">
        <x-nav :msg="$title" />
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    <script>
        $(window).on('load', function() {
            $("#loading").fadeOut(1000);
        });
    </script>

    @stack('page-script')
</body>

</html>