<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <title>{{ config('app.name', 'Agendamento Médico') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <app app-name="{{ config('app.name', 'Agendamento Médico') }}">
            <template slot="content">
                @yield('content')
            </template>
        </app>
    </div>

    <!-- Scripts -->
    <script>
        var logged = {!! $logged !!};
    </script>
    <script src="{{ asset('/js/traducao.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('extraScripts')
</body>
</html>
