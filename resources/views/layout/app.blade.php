<!doctype html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{url('/css/style.css')}}">
    <title>Document</title>
</head>
<body class="min-vh-100 d-flex flex-column">
@include('layout.header')

<div id="content">
    @yield('content')
</div>
</body>
@include('layout.footer')
</html>
