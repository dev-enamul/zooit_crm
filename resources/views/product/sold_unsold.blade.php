@extends('layouts.dashboard')
@section('title','Product Sold & Unsold')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Sold & Unsold</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Sold & Unsold</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
                           <div class="d-flex justify-content-between"> 
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-pdf"></i> pdf</span>
                                        </button> 
                                    </div> 
                                </div>
                             
                           </div>
                           
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                 <tbody>
                                    <tr class=""> 
                                        <td><b>4th Floor</b></td>
                                        <td class="bg-danger text-white">Garaze 01</td>
                                        <td class="bg-primary text-white">Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td> 
                                    </tr> 
                                    <tr class=""> 
                                        <td><b>3rd Floor</b></td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td> 
                                    </tr>
                                    <tr class=""> 
                                        <td><b>2nd Floor</b></td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td> 
                                    </tr>
                                    <tr class=""> 
                                        <td><b>1st Floor</b></td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td> 
                                    </tr> 
                                   <tr class=""> 
                                        <td><b>Ground Floor</b></td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>  
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td>
                                        <td>Garaze 01</td> 
                                    </tr> 
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
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