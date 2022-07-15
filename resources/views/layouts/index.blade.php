<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Inicio</title>
        <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet"   href="{{asset('css/styles.css')}}">
        <link rel="stylesheet"    href="{{asset('plugins/fontawesome-free/css/all.css')}}">
    </head>
    <body>

        {{-- Sweet Alert 2 --}}
        <script src="{{asset('js/sweetalert/sweetalert2.all.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        {{-- <script src="{{asset('code.jquery.com/jquery-1.11.1.min.js')}}"></script> --}}
    </body>
</html>


