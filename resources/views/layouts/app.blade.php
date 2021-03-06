<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.css">
</head>
<body>
    <div id="app">
        @include('layouts._navbar')
        @if(!auth()->guest() && auth()->user()->user_type == 'student')
            @include('layouts._student-info')
        @endif
        <div style="min-height: 600px; height: 100%; display: block">
            @yield('content')
        </div>

        <div class="col-md-12">
            @include('layouts._footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.js"></script>
    @include('sweet::alert')

    @yield('scripts')
    <script>
      document.addEventListener('contextmenu', function(e) {
        // e.preventDefault();
      });

      $('form').on('submit', function() {
        $('button[type="submit"]').attr('disabled', 'disabled');
      })
    </script>
</body>
</html>
