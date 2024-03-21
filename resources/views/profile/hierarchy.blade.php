@extends('layouts.dashboard')
@section('title',"Profile")

@section('style') 
        <link rel="stylesheet" href="{{asset('assets/libs/jstree/themes/default/style.min.css')}}" />
@endsection 

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9"> 
                    {{-- @include('includes.freelancer_profile_data') --}}
              

                    <div class="card">
                        <div class="card-header">
                            My Employee
                        </div>
                        <div class="card-body">
                            <div id="jstree-1"> 
                                <ul>
                                    <li  data-jstree='{ "opened" : true }'>
                                        {{Auth::user()->name}}
                                        @include('includes.down_employee')
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

    <script>  
        barChart("abc");
        barChart("aaa");
    </script>
@endsection