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
    <style type="text/css">
      .sidemenu-child {
        /*margin-left: 10px;*/
        /*margin-top: 5px;*/
      }

      .sidemenu {
        border: 1px solid #660000;
      }

      .sidemenu-child > .sidemenu-item {
        background: #E8E8E8;
        color: #660000;
      }

      .sidemenu-item {
        border: 0;
        display: block;
        width: 100%;
        padding: 15px;
        text-decoration: none !important;
      }

      .sidemenu-child > .sidemenu-item:hover {
        background: #D3C8C8;
      }

      .sidemenu > .sidemenu-item {
        background: #660000;
        /*background: #BD9A9A;*/
        color: #fff;
      }

      .sidemenu > .sidemenu-item:hover {
        /*color: #660000;*/
        color: #fff;
        background: #BD9A9A;
      }

      /*.sidemenu .list-group-item:hover {
        background: #fff !important;
        color: dark !important;
      }*/

      .sidemenu > .list-group-item {
        /*background: red;*/
      }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts._navbar')

        <div class="container-fluid">
            <div class="col-md-3">
                @include('layouts._sidemenu')
            </div>
            <div class="col-md-9" style="min-height: 600px">
                @yield('content')
            </div>
        </div>

        @include('layouts._footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    @include('sweet::alert')

    @yield('scripts')
</body>
</html>
