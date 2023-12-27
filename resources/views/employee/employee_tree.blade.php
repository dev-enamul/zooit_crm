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
                                <ul>
                                    <li  data-jstree='{ "opened" : true }'>
                                        MD Enamul Haque
                                        <ul> 
                                            <li data-jstree='{ "opened" : true }'>
                                                Md Enamul Haque
                                                <ul>
                                                    <li data-jstree='{ "opened" : true }'>Jahid Hasan
                                                        <ul>  
                                                            <li data-jstree='{ "opened" : true }'>
                                                                Jamil
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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

                                                            <li data-jstree='{ "opened" : true }'>
                                                                Jamil
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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

                                                    <li data-jstree='{ "opened" : true }'>Jahid Hasan
                                                        <ul>  
                                                            <li data-jstree='{ "opened" : true }'>
                                                                Jamil
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Emily Johnson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>David Miller</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Sophia Davis</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Michael Brown</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Olivia Wilson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Daniel Jones</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Isabella Taylor</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Matthew Anderson</li>
                                                                    <li data-jstree='{ "type" : "file" }'>Ava Martinez 
                                                                        <ul>  
                                                                            <li data-jstree='{ "type" : "file" }'>Isabella Taylor 
                                                                                <ul>
                                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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
                                                                            <li data-jstree='{ "type" : "file" }'>Matthew Anderson 
                                                                                <ul>
                                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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
                                                                            <li data-jstree='{ "type" : "file" }'>
                                                                                Michael Brown
                                                                                <ul>
                                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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

                                                            <li data-jstree='{ "opened" : true }'>
                                                                Jamil
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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

                                            <li data-jstree='{ "opened" : true }'>
                                                Md Enamul Haque
                                                <ul>
                                                    <li data-jstree='{ "opened" : true }'>Jahid Hasan
                                                        <ul>  
                                                            <li data-jstree='{ "opened" : true }'>
                                                                Jamil
                                                                <ul>
                                                                    <li data-jstree='{ "type" : "file" }'>John Smith</li>
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

                                            <li data-jstree='{ "opened" : true }'>
                                                Md Enamul Haque
                                                <ul>
                                                    <li data-jstree='{ "opened" : true }'>
                                                        Jamil
                                                        <ul>
                                                            <li data-jstree='{ "type" : "file" }'>John Smith</li>
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