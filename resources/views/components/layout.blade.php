<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? " "}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Apply the saved color from localStorage as soon as possible
        (function() {
            const savedColor = localStorage.getItem('primaryColor');
            if (savedColor) {
                document.documentElement.style.setProperty('--bs-primary-rgb', savedColor);
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
            --bs-primary-rgb: 240, 146, 89;
        }
    </style>
</head>

<body class="bg-light">
    <div class="px-lg-7">
        <x-nav :msg="$title" />
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    @stack('page-script')
</body>

</html>