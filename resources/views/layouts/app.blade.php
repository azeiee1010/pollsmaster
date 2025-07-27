<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PollsMaster</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('head')
</head>

<body>

    @yield('content')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js (required for Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- CSRF setup for AJAX -->
    <script>
        $.ajaxSetup({
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('access_token')
            }
        });

         // Redirect to login if no token and not allowed guest access
        (function() {
            const token = localStorage.getItem("access_token");
            const allowGuest = window.allowGuestPage || true;

            if (!token && !allowGuest) {
                window.location.href = "/login";
            }
        })();
        

    </script>
    {{-- <script src="{{ asset('assets/js/auth-guard.js') }}"></script> --}}



    <!-- Blade stack scripts (e.g. @push('scripts')) -->
        @stack('scripts')

    </body>

    </html>
