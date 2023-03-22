<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Doctor Appointment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href='{{ asset('css/bootstrap.min.css') }}'>
        <link rel="stylesheet" href='{{ asset('css/main.css') }}'>
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
        
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
        
        <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

        
        <!-- TOASTR JS -->
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}','Error ! ',{
                closeButton:true,
                progressBar:true,
            });
            @endforeach
            @endif
        </script>
        <!-- custom page js -->
        @stack('js')
    </body>
</html>
