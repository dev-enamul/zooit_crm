@extends('layouts.dashboard')
@section('title','Target Achivement')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Target Achivement</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Target Achivement    </li>
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
                                 
                                </div>
                                <div class="">   
                                    <form action="" method="get" action="">
                                        <div class="input-group">  
                                            <input class="form-control" type="month" name="month" value="{{$selected != ''?$selected:now()->format('Y-m') }}"/>   
                                            <button class="btn btn-secondary" type="submit">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </form> 
                                </div>
                           </div>

                           <div class="table-box" style="overflow-x: scroll;">
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>S/N</th>
                                        <th>Employee Name</th>  
                                        <th>FL Recruitment</th>
                                        <th>Customer Data</th> 
                                        <th>Prospecting</th>
                                        <th>Cold calling</th>
                                        <th>Lead</th>
                                        <th>Lead Analysis</th>
                                        <th>Project Visit</th>
                                        <th>Project Visit Analysis</th>
                                        <th>Follow Up</th>
                                        <th>Follow Up Analysis</th>
                                        <th>Negotiation</th>
                                        <th>Negotiation Analysis</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $data)
                                        <tr> 
                                            <td>1</td>
                                            <td>{{@$data->assignTo->name}}</td>  
                                            <td class="align-middle">{{$data->freelancer}} </td>  
                                            <td class="align-middle">{{$data->customer}}  </td>  
                                            <td class="align-middle">{{$data->prospecting}}</td>  
                                            <td class="align-middle">{{$data->cold_calling}}</td>  
                                            <td class="align-middle">{{$data->lead}}</td>  
                                            <td class="align-middle">{{$data->lead_analysis}}</td>  
                                            <td class="align-middle">{{$data->project_visit}}</td>  
                                            <td class="align-middle">{{$data->project_visit_analysis}}</td>  
                                            <td class="align-middle">{{$data->follow_up}}</td>  
                                            <td class="align-middle">{{$data->follow_up_analysis}}</td>  
                                            <td class="align-middle">{{$data->negotiation}}</td>  
                                            <td class="align-middle">{{$data->negotiation_analysis}}</td>   
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                           </div> 
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

@section('script')
<script>
    barChart("abc"); 
    getDateRange('daterangepicker');
</script>
@endsection