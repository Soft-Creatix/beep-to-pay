@extends('admin.layouts.app')
@section('title', 'Create User')
@push('styles')
<!--begin::Page Vendors Styles(used by this page)-->
<link href="{{ asset('admin/assets/plugins/custom/intlTelInput/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
<!--end::Page Vendors Styles-->
@endpush
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Create User</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Manage Access</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Users</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted">Create User</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="{{ route('user.index') }}" class="btn btn-light-warning font-weight-bolder btn-sm">< Back</a>
                <!--end::Actions-->
                {{--
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-2x">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header font-weight-bold py-4">
                                <span class="font-size-lg">Choose Label:</span>
                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="navi-separator mb-3 opacity-70"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-success">Customer</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-danger">Partner</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-primary">Member</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-dark">Staff</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-separator mt-3 opacity-70"></li>
                            <li class="navi-footer py-4">
                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdown--> --}}
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">Create User</h3>
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    {{-- <span class="example-copy" data-toggle="tooltip" title="Copy code"></span> --}}
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name..." name="name" id="name" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group-label">
                                    <label>Profile Image</label>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <span class="form-text text-muted mb-2">Please uplaod image less than 2MB.</span>
                                </div>
                                <div class="form-group">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_input" style="background-image: url({{ asset('admin/assets/media/users/blank.png') }})">
                                        <div class="image-input-wrapper"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change user profile image">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" accept="image/*"  placeholder="Select user profile image..." name="image" id="image" />
                                            <input type="hidden" name="profile_avatar_remove"/>
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="image-cancel" data-action="cancel" data-toggle="tooltip" title="Cancel user profile image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" id="image-remove" data-action="remove" data-toggle="tooltip" title="Remove user profile image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email
                                    <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email..." name="email" id="email" value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group">
                                    <label>Contact No.
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" placeholder="Enter contact number..." name="contact_no" id="contact_no" value="{{ old('contact_no') }}" required />
                                    @error('contact_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control @error('designation') is-invalid @enderror" placeholder="Enter designation..." name="designation" id="designation" value="{{ old('designation') }}" />
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group">
                                    <label>Password
                                    <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password..." name="password" id="password" required />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password
                                    <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new confirm password..." name="password_confirmation" id="password_confirmation" required />
                                    {{-- @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                    {{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
                                </div>
                                <div class="form-group">
                                    <label>Role:
                                    <span class="text-danger">*</span></label>
                                    <select data-live-search="true" class="form-control selectpicker  @error('role') is-invalid @enderror" data-size="7"  name="role">
                                        <option value="">Select</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" @if(old('role')) selected="true" @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@push('scripts')
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('admin/assets/plugins/custom/intlTelInput/js/intlTelInput.js') }}"></script>
<!--end::Page Vendors-->
<script type="text/javascript">
    $("#contact_no").intlTelInput();
</script>
<script>
    var imageInput = new KTImageInput('kt_image_input');

    imageInput.on('change', function(imageInput) {

        var uploadField = document.getElementById("image");

        if(uploadField.files[0].size > 2101546) {
            swal.fire({
                title: 'File size is greater than 2 MB!',
                type: 'warning',
                icon: 'warning',
                buttonsStyling: false,
                confirmButtonText: 'Change now!',
                confirmButtonClass: 'btn btn-warning font-weight-bold'
            });

            removeImage();

            uploadField.value = "";
        };
    });

    function removeImage() {
        setTimeout(function(){ $('#image-cancel').click() }, 1000);
    }
</script>
@endpush
