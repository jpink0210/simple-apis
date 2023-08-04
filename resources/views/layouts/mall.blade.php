<html>
    <head>
        <title>電子購物系統</title>
        @include('layouts.assets.bootstrap')
        @include('layouts.assets.jquery')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/3b5743464b.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @include('layouts.nav')
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>