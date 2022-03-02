<head>
    <!-- meta tags -->
    <meta charset="utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="title" content="@yield('meta_title')">

    <meta name="token" content="{{ csrf_token() }}" />

    <meta name="keywords" content="@yield('meta_keywords')" />

    <meta name="description" content="@yield('meta_description')" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- title -->
    <title>@yield('title')</title>

    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="{{ asset('website/style.css') }}" />

    @stack('styles')

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
