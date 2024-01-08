<!doctype html>
<html lang="en"> 
<head> 
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name', 'ZOOM IT') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    {{-- Select 2 --}}
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" /> 

    <link href="{{asset('assets/libs/daterangepicker/daterangepicker.css')}}" rel="stylesheet"> 
   
 

    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    @yield('style')

</head>

<body> 
    <div id="layout-wrapper">  
        @include('includes.header') 
        @include('includes.sidebar') 
        @yield('content')
    </div>  
  
    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

  
    {{-- Form Validation  --}}
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

    {{-- Select 2 --}}
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-select2.init.js')}}"></script>

    {{-- Date Picker --}}
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-datepicker.init.js')}}"></script>

    {{-- Date Range  --}}
    <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/daterangepicker/daterangepicker.js')}}"></script>  
    <script src="{{asset('assets/js/pages/form-rangepicker.init.js')}}"></script>

    {{-- chart  --}} 
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>   
    <script src="{{asset('assets/js/pages/apexcharts-column.init.js')}}"></script>

   
    <script src="{{asset('assets/js/app.js')}}"></script>
 
    @yield('script')
</body>


<!-- Mirrored from Zoom IT.in/Zoom IT/layout/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 Nov 2023 10:06:06 GMT -->
</html>