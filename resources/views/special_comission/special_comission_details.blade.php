@extends('layouts.dashboard')
@section('title','Bijoy Offer')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Bojoy Offer </h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Bojoy Offer</li>
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
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button> 
                                    </div> 
                                </div>

                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <a class="btn btn-secondary" href="{{route('special-comission.index')}}">
                                            <span><i class="mdi mdi-keyboard-backspace"></i> Back</span>
                                        </a> 
                                    </div>
                                </div>
                           </div>

                           <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr> 
                                    <th>S/N</th>
                                    <th>Profession Name</th> 
                                    <th>Commision</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                <tr> 
                                    <td>1</td>
                                    <td>Managing Derector</td>  
                                    <th>2%</th> 
                                </tr>

                                <tr>  
                                    <td>1</td>
                                    <td>Sr. Marketing Executive</td>  
                                    <th>4%</th> 
                                </tr>

                                <tr>  
                                    <td>1</td>
                                    <td>Area In Charge</td>  
                                    <th>1%</th> 
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
    @include('includes.footer')
</div> 
@endsection