@extends('layouts.dashboard') 
@section('title','Employee Tree') 
@section('style')   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://codepen.io/joellesenne/pen/pdMPdW.css'>
        <style> 
            @media print {
                @page {
                    size: landscript;
                    margin-top: 10mm; 
                }

                html, body {
                    height:100vh; 
                    margin: 0 !important; 
                    padding: 0 !important;
                    overflow: hidden;
                }
               
            } 
        </style>  

<style>
    *,
    *:before,
    *:after {
    box-sizing: border-box !important;
    }

    * {
    position: relative;
    margin: 0;
    padding: 0;
    border: 0 none;
    transition: all ease .4s;
    }

    html,
    body {
    width: 100%;
    height: 100%;
    font-family: 'Fjalla One', sans-serif;
    font-size: 10px;
    background: RGBA(0, 58, 97, 1)
    }

    h1 {
    padding-top: 40px;
        
    color: #ccc;
    text-align: center;
    font-size: 1.8rem;
        
        text-shadow: rgba(0,0,0,0.6) 1px 0, rgba(0,0,0,0.6) 1px 0, rgba(0,0,0,0.6) 0 1px, rgba(0,0,0,0.6) 0 1px;
    }

    .nav {
    
    width: 455px;
    min-height: auto;
    }

    .nav ul {
    position: relative;
    padding-top: 20px; 
    }

    .nav li {
    position: relative;
    padding: 20px 3px 0 3px; 
    float: left; 
    
    text-align: center;
    list-style-type: none; 
    }

    .nav li::before, .nav li::after{
    content: '';
    position: absolute; 
    top: 0; 
    right: 50%;
    width: 50%; 
    height: 20px;
    border-top: 1px solid #ccc;
    }

    .nav li::after{
    left: 50%;
    right: auto; 
    
    border-left: 1px solid #ccc;
    }

    .nav li:only-child::after, .nav li:only-child::before {
    content: '';
    display: none;
    }

    .nav li:only-child{ padding-top: 0;}
    .nav li:first-child::before, .nav li:last-child::after{
    border: 0 none;
    }

    .nav li:last-child::before{
    border-right: 1px solid #ccc;
    border-radius: 0 5px 0 0;
    }

    .nav li:first-child::after{
        border-radius: 5px 0 0 0;
    }
    .nav ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 1px solid #ccc;
    width: 0; 
    height: 20px;
    }

    .nav li a{
    display: inline-block;
    padding: 5px 10px;
    
    border-radius: 5px;
    border: 1px solid #ccc;
    
    text-decoration: none;
    text-transform: uppercase;
    color: #ccc;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    }

    .nav li a:hover, .nav li a:hover+ul li a {
    color: #000;
    background: #c8e4f8;   
    border: 1px solid #94a0b4;
    }

    .nav li a:hover+ul li::after, 
    .nav li a:hover+ul li::before, 
    .nav li a:hover+ul::before, 
    .nav li a:hover+ul ul::before{
    content: '';
    border-color: #94a0b4;
    }
</style>

@endsection  
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <button class="btn btn-secondary buttons-pdf buttons-html5" id="print" type="button"><span><i class="fa fa-print"></i> Print</span></button> 
                        </div>

                        <div class="">   
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <select class="select2" search name="employee" id="employee" required>
                                        <option value="{{auth()->user()->id}}" selected="selected">{{Auth::user()->name}}</option>
                                    </select>
                                    <button class="btn btn-secondary" type="submit">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </form> 
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">  
                    <div class="card">
                       <div class="card-header">
                            <h4 class="card-title text-center">{{$employee->name}} [{{$employee->user_id}}]</h4>
                       </div>
                        <div class="card-body"> 
                            <nav class="nav">
                                <ul>
                                    <li>
                                        <div> 
                                            <img width="50px" src="" alt="">
                                            <a href="#">Home</a>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="#">Lab</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Code</a>
                                                        <ul>
                                                            <li>
                                                                <a href="#">Html</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="#">Css</a>
                                                                        <ul>
                                                                            <li>
                                                                                <a href="#">Jquery</a>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="#">Graph</a>
                                                        <ul>
                                                            <li>
                                                                <a href="#">Image</a>
                                                                <ul>
                                                                    <li>
                                                                        <a href="#">Design</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Blog</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Category</a>
                                                        <ul>
                                                            <li>
                                                                <a href="#">Code</a>
                                                            </li>
                                                            <li>
                                                                <a href="#">Graph</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">About</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Vcard</a>
                                                        
                                                    </li>
                                                    <li>
                                                        <a href="#">Map</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>

                            {{-- <div class="row">
                                <div class="tree">
                                    <ul>
                                        <li> <a href="#"><img src="{{$employee->image()}}"><span>{{$employee->name}} <br> {{$employee->user_id}}</span></a>
                                        @include('includes.down_hierachy',[ 'depth' => 1])
                                     
                                    </ul>
                                </div>
                            </div> --}}
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

    <script>
          $(document).ready(function() { 
            $('#employee').select2({
                placeholder: "Select Employee",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.employee') }}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            term: params.term
                        }
                        return query;
                    }
                }
            });

            $('#print').on('click', function() {
                window.print();
            });
        });
    </script>
@endsection