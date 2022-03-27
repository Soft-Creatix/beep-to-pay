
<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.partials.head')
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		@include('admin.layouts.partials.mobile-header')
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				@include('admin.layouts.partials.aside-menu')
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					@include('admin.layouts.partials.header')
					@yield('content')
					@include('admin.layouts.partials.footer')
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
        <!--begin::Panels-->
		@include('admin.layouts.panels.user-panel')
		{{-- @include('admin.layouts.panels.quick-cart-panel') --}}
		{{-- @include('admin.layouts.panels.quick-panel') --}}
		{{-- @include('admin.layouts.panels.chat-panel') --}}
		{{-- @include('admin.layouts.panels.sticky-toolbar') --}}
        <!--end::Panels-->
        @include('admin.layouts.panels.scroll-top')
        @include('admin.layouts.partials.scripts')
	</body>
	<!--end::Body-->
</html>
