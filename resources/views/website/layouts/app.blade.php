<!DOCTYPE html>
<html lang="en">
    @include('website.layouts.partials.head')
    <body class="bg-grey-made">
        @include('website.layouts.partials.navbar')
        @yield('content')
        @include('website.layouts.partials.footer')
        @include('website.layouts.partials.scripts')
    </body>
</html>
