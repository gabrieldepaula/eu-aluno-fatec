<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EuAlunoFatec</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fugaz+One">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/adminlte/css/adminlte.min.css') }}">
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('student.template.header')
        @include('student.template.sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('student.template.footer')
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/adminlte/js/adminlte.js') }}"></script>
    @stack('js')
</body>
</html>