@extends('layouts.dashboard')
@section('title',"Monthly Target Vs Achivement") 
@section('style') 
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content') 
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Target Achivement</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Datatable</a></li>
                                <li class="breadcrumb-item active">Monthly Target Achivement</li>
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
                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employee Name</th>
                                        <th>Employee ID</th>
                                        <th>Target</th>
                                        <th>Achivement</th>
                                        <th>Achieve Percentage</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{@$data->assignTo->name}}</td>
                                            <td>{{@$data->assignTo->user_id}}</td>
                                            @php
                                                if($data->is_project_wise==0){
                                                    $target = $data->new_total_deposit + $data->existing_total_deposit;
                                                }else{
                                                    $target = $data->depositTargetProjects->sum('new_deposit') + $data->depositTargetProjects->sum('existing_deposit');
                                                }
                                            @endphp
                                            <td>{{get_price($target)}}</td> 

                                            @php  
                                                if(isset($data->assign_to) && $data->assign_to != null){
                                                    $achive = \App\Models\Deposit::where('employee_id', $data->assign_to)
                                                                ->whereNotNull('approve_by') 
                                                                ->whereMonth('created_at', date('m'))
                                                                ->whereYear('created_at', date('Y'))
                                                                ->sum('amount');
                                                }
                                            @endphp 

                                            <td>{{get_price($achive)}}</td>
                                            <td>{{get_percent($achive,$target)}}</td> 
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
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

  <!-- Required datatable js -->
  <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>

  <!-- buttons examples -->
  <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
  {{-- <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script> --}}
  <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
  {{-- <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script> --}}

  <!-- Responsive examples -->
  <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script>

  <!-- Datatable init js -->
  <script src="{{asset('assets/js/pages/datatables-extension.init.js')}}"></script>
  
    <script>
        getDateRange('duration')
    </script>
@endsection