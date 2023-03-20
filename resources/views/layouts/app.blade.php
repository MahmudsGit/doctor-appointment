<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Doctor Appointment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href='css/bootstrap.min.css'>
        <link rel="stylesheet" href='css/main.css'>
        
        <!-- Custom Page css -->
        @stack('css')
    </head>
    <body class="antialiased">
        <!-- navbar -->
        @include('partials.navbar')

        <!-- content -->
        @yield('content')
        
        <!-- footer -->
        @include('partials.footer')
        
        <script src="'js/bootstrap.min.js'"></script>

        <!-- custom page js -->
        @stack('js')
    </body>
</html>
