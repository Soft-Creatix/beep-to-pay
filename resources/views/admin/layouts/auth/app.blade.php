
<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.partials.head')
	<!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		@yield('content')
        @include('admin.layouts.partials.scripts')
	</body>
	<!--end::Body-->
</html>
