<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() === 'en' ? 'ltr' : 'rtl'}}">
<head>
    {{--    pwa--}}
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <link rel="apple-touch-icon" href="{{asset('images/96x96.png')}}">
    <meta name="theme-color" content="#027B9A"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#004658">
    <meta name="apple-mobile-web-app-title" content="Kiki Riki">
    {{--    End pwa--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('logo.jpeg')}}">
    <title>{{ config('app.name', 'KikiRiki') }}</title>

    @if (app()->getLocale() === 'en')


    <!-- Vendors Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/vendors_css.css')}}">

        <!-- Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/skin_color.css')}}">
    @else
    <!-- Vendors Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl_vendors_css.css')}}">

        <!-- Style-->
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl.css')}}">
        <link rel="stylesheet" href="{{asset('admin-dashboard/css/rtl_skin_color.css')}}">
    @endif
    {{-- toaster --}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">--}}
    <link rel="stylesheet" href="{{asset('somePacks/toaster.css')}}">
    <style>
        #profileImage {
            width: 43px;
            height: 43px;
            border-radius: 50%;
            background: #512DA8;
            color: #fff;
            text-align: center;
            line-height: 43px;
        }
    </style>
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

{{-- Header --}}
@include('body.header')

<!-- Left side column. contains the logo and sidebar -->
@include('body.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- content here --}}
        @yield('admin')
    </div>
    <!-- /.content-wrapper -->
{{-- footer --}}
@include('body.footer')

<!-- Control Sidebar -->
    <!-- /.control-sidebar -->

    {{--<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>--}}

</div>
<!-- ./wrapper -->


<!-- Vendor JS -->
@if (!Request::is(app()->getLocale().'/admin'))
    <script src="{{asset('admin-dashboard/js/vendors.min.js')}}"></script>
@endif
<script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')}}"></script>
<script src="{{asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js')}}"></script>
<script src="{{asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>

{{-- data table --}}
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('datatable-lang.js')}}"></script>
<script src="{{asset('admin-dashboard/js/pages/data-table.js')}}"></script>

<!-- Sunny Admin App -->
<script src="{{asset('admin-dashboard/js/template.js')}}"></script>
<script src="{{asset('admin-dashboard/js/pages/dashboard.js')}}"></script>

{{-- DataTable Edit --}}
<script>
    $(document).ready(function () {
        $('div.example1_length select').css('width', '100% !important');
        let o400 = new Option("option text", "99000000");
        $(o400).html("{{__('All')}}");
        setTimeout(function () {
            $("select[name='example1_length']").append(o400);
        }, 900)
    });
</script>

{{-- Excell --}}
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="{{asset('somePacks/xlsx.full.min.js')}}"></script>

<script>
    $(document).ready(function () {
        var intials = $('#name').text().charAt(0);
        var profileImage = $('#profileImage').text(intials);
    });
</script>
{{-- toaster --}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>--}}
<script src="{{asset('somePacks/toastr.min.js')}}"></script>
<script>
    @if (Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}"
    toastr.options = {
        "closeButton": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}")
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}")
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}")
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}")
            break;
    }
    @endif
</script>
<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{asset('sw.js')}}')
            .then(reg => console.log('sw registerd', reg))
            .catch(err => console.log('sw registerd error', err))
    }
</script>

</body>
</html>
