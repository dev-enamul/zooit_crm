@extends('layouts.dashboard') 
@section('title','Employee Tree') 
@section('style') 
        <link rel="stylesheet" href="{{asset('assets/libs/jstree/themes/default/style.min.css')}}" />
@endsection 

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-header-bordered">
                            <h3 class="card-title">Employee</h3>
                        </div>
                        <div class="card-body">
                            <div id="jstree-1"> 
                               @include('includes.down_employee')
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- End Page-content -->

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