<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    @stack('styles')
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('admin/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <!-- For Light Mode -->
    <link href="{{ asset('admin/assets/css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css" />
    <!-- For Light Mode -->
    <!-- For Dark Mode -->
    {{-- <link href="{{ asset('admin/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- For Dark Mode -->
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/favicon.ico') }}" />
</head>
<!--end::Head-->
