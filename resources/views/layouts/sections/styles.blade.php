<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/boxicons.css')) }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/theme-default.css')) }}" />

<link rel="stylesheet" href="{{ asset(mix('assets/css/sweetalert2.min.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('assets/css/dropify.min.css')) }}" />

<link rel="stylesheet" href="{{ asset('/assets/css/summernote-bs4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/assets/css/dataTables.min.css') }}" />

{{-- <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome-all.css') }}" /> --}}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

<link rel="stylesheet" href="{{ asset('/assets/css/app.css') }}" />



{{-- <link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" /> --}}
<link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />




<!-- Vendor Styles -->
@yield('vendor-style')


<!-- Page Styles -->
@yield('page-style')

@if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/arabic.css') }}" />
@endif
