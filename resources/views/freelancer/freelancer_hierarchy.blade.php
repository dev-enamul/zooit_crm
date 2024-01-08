@extends('layouts.dashboard')
@section('title',"Profile");
@section('style') 
        <link rel="stylesheet" href="{{asset('assets/libs/jstree/themes/default/style.min.css')}}" />
@endsection 
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           @include('includes.freelancer_profile_data')

            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.freelancer_menu')
                </div> 
                <div class="col-md-9"> 
                    <div class="card overflow-hidden"> 
                        <div class="card-body border-top">
                            <div id="jstree-1">
                                <ul>
                                    <li  data-jstree='{ "opened" : true }'>
                                        MD Enamul Haque
                                        <ul> 
                                            <li data-jstree='{ "opened" : true }'>
                                                <img src="{{asset('assets/images/users/avatar-6.png')}}" alt="" width="15px">
                                                Md Enamul Haque -0196563666 #8767 -Zonal Manager
                                                <ul>
                                                    <li data-jstree='{ "opened" : true }'>
                                                        <img src="{{asset('assets/images/users/avatar-6.png')}}" alt="" width="15px">
                                                        Jahid Hasan -01898765435 #7567 -Area Incharge
                                                        <ul>   
                                                            <li data-jstree='{ "opened" : true }'>
                                                                <img src="{{asset('assets/images/users/avatar-6.png')}}" alt="" width="15px">
                                                                Jamil -01756543215 #7567 -Marketing Executive
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file","selected":"true"}'>
                                                                        <img src="{{asset('assets/images/users/avatar-6.png')}}" alt="" width="15px"> 
                                                                        John Smith 01796351081 #7567 Sr.Marketing Executive
                                                                    </li>
                                                                    <li data-jstree='{ "type" : "file" }'>Emily Johnson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>David Miller</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Sophia Davis</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Michael Brown</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Olivia Wilson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Daniel Jones</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Isabella Taylor</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Matthew Anderson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Ava Martinez</li>
                                                                </ul>
                                                            </li> 
                                                        </ul>
                                                    </li> 

                                                   
                                                </ul>
                                            </li> 
                                           
                                        </ul>
                                    </li>
                                     
                                </ul>
                            </div>
                        </div>  
                    </div> 
                </div>
            </div> 
        </div> 
    </div> 

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection 

@section('script') 
    <script src="{{asset('assets/libs/jstree/jstree.min.js')}}"></script>  
    <script src="{{asset('assets/js/pages/treeview.init.js')}}"></script>
@endsection