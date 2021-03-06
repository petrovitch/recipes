<!DOCTYPE html>
<html>
<head>
    <title> @yield('title') </title>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/glyphicons.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/glyphicons.files.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/glyphicons.pro.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/glyphicons.social.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/glyphicons.bootstrap.css') !!}">
    {{--<link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}">--}}
    {{--<link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap-theme.min.css') !!}">--}}

    {{--Material Design Theme--}}
    <link rel="stylesheet" type="text/css" href="{!! asset('css/roboto.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/material.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! asset('css/ripples.min.css') !!}">

    <link rel="stylesheet" type="text/css" href="{!! asset('css/toastr.css') !!}">
<body>

@include('_partials.navbar')

@yield('content')

<script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>

{{--Material Design Theme--}}
<script src="{!! asset('js/ripples.min.js') !!}"></script>
<script src="{!! asset('js/material.min.js') !!}"></script>

<script src="{!! asset('js/bootstrap-datepicker.js') !!}"></script>
<script src="{!! asset('js/bootstrap-timepicker.js') !!}"></script>
<script src="{!! asset('js/toastr.js') !!}"></script>

{!! Toastr::render() !!}
{!! Toastr::clear() !!}

</body>
</html>
