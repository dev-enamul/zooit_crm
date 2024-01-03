@extends('layouts.dashboard')
@section('title','Deposit Target') 
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target</li>
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
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
                                        </button> 
                                    </div> 
                                    {{-- <div class="dt-buttons btn-group flex-wrap mb-2">     
                                        <button class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#modal6"> <i class="mdi mdi-chart-box-outline"></i> View Chart</button> 
                                    </div> --}}
                                </div>
                                <div class="">  
                                    <div class="input-group">  
                                        <input class="form-control" type="month" value="{{ now()->format('Y-m') }}"/>   
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th rowspan="2">Action</th>
                                        <th rowspan="2">S/N</th>
                                        <th rowspan="2">Project</th> 
                                        <th rowspan="2">Unit & Amount</th> 
                                        <th colspan="2">Md Enamul Haque (EMP 013) - RMG</th>
                                        <th colspan="2">Md Jahid Hasan (EMP 014) - RMG</th> 
                                        <th colspan="2">Total</th> 
                                    </tr> 
                                    
                                    <tr>  
                                        <th>Unit</th>
                                        <th>Deposit</th>
                                        <th>Unit</th>
                                        <th>Deposit</th> 
                                        <th>Unit</th>
                                        <th>Deposit</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr> 
                                        <td rowspan="2" class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('deposit.target.asign')}}">Edit Target</a> 
                                                </div>
                                            </div> 
                                        </td>
                                        <td  rowspan="2">1</td>
                                        <td  rowspan="2">Wahidul Islam Plaza, Ramgonj</td>
                                        <td class="align-middle">Existing</td> 
                                        <td class="align-middle">1</td> 
                                        <td class="align-middle">2000000</td>

                                        <td class="align-middle">2</td> 
                                        <td class="align-middle">3000000</td>  

                                        <td class="align-middle">2</td> 
                                        <td class="align-middle">3000000</td>  
                                    </tr>  
                                    <tr>   
                                        <td class="align-middle">New Salse</td>  
                                        <td class="align-middle">1</td> 
                                        <td class="align-middle">2000000</td>

                                        <td class="align-middle">2</td> 
                                        <td class="align-middle">3000000</td>  

                                        <td class="align-middle">2</td> 
                                        <td class="align-middle">3000000</td>  
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

<div class="modal fade" id="modal6">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Achivement <span class="text-info">[1 May-2023 - 30 May, 2023]</span></h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>
            <div class="modal-body">
                <div id="abc"
                    data-colors='["--bs-primary", "--bs-success"]'
                    class="apex-charts"
                    data-series='[{"name": "Target", "data": [90, 60, 70, 80, 90]},{"name": "Achivement", "data": [80, 60, 50, 40, 10]}]'
                    data-xaxis-categories='["Freelancer Join", "Customer Join", "Prospecting", "Cold Calling", "Lead"]'
                    data-height="400">
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection 
 