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
                                {{-- <div class="">
                                    <div class="btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button> 
                                    </div> 
                                </div>
                                <div class="">  
                                    <div class="input-group">  
                                        <input class="form-control" type="month" value="{{ now()->format('Y-m') }}"/>   
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div> --}}
                           </div>

                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        {{-- <th>Action</th> --}}
                                        <th>S/N</th>
                                        <th>Project</th> 
                                        <th>Existing Unit</th>
                                        <th>Existing Deposit</th>
                                        <th>New Unit</th> 
                                        <th>New Deposit</th> 
                                    </tr>   
                                </thead>
                                <tbody>  
                                    @if (isset($datas) && $datas->is_project_wise==1) 
                                    @if (isset($datas->depositTargetProjects) && count($datas->depositTargetProjects) > 0)
                                        @php
                                            $totalExistingUnit = 0;
                                            $totalExistingDeposit = 0;
                                            $totalNewUnit = 0;
                                            $totalNewDeposit = 0;
                                        @endphp

                                        @foreach ($datas->depositTargetProjects as $key => $data)
                                            <tr> 
                                                <td>{{$key+1}}</td>
                                                <td>{{@$data->project->name}}</td>
                                                <td class="align-middle">{{$data->existing_unit}}</td>
                                                <td class="align-middle">{{get_price($data->existing_deposit)}}</td>
                                                <td class="align-middle">{{$data->new_unit}}</td>
                                                <td class="align-middle">{{get_price($data->new_deposit)}}</td>
 
                                                @php
                                                    $totalExistingUnit += $data->existing_unit;
                                                    $totalExistingDeposit += $data->existing_deposit;
                                                    $totalNewUnit += $data->new_unit;
                                                    $totalNewDeposit += $data->new_deposit;
                                                @endphp
                                            </tr>
                                        @endforeach 
                                        <tr>
                                            <th colspan="2">Total</th>
                                            <th>{{$totalExistingUnit}}</th>
                                            <th>{{get_price($totalExistingDeposit)}}</th>
                                            <th>{{$totalNewUnit}}</th>
                                            <th>{{get_price($totalNewDeposit)}}</th>
                                        </tr>
                                    @endif
                                    @elseif(isset($datas) && $datas->is_project_wise==0)
                                        <th>1</th>
                                        <th>-</th> 
                                        <th>-</th>
                                        <th>{{get_price($datas->existing_total_deposit)}}</th>
                                        <th></th> 
                                        <th>{{get_price($datas->new_total_deposit)}}</th> 
                                    @endif
                                    
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

@section('script')
<script>
    barChart("abc"); 
    getDateRange('daterangepicker');
</script>
@endsection