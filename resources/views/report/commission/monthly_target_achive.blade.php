@extends('layouts.dashboard')
@section('title',"Monthly Target Vs Achivement") 
@section('style') 
  
@endsection

@section('content') 
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-sm-0">Monthly Target Achivement</h4> 
                            <p class="d-none">{{get_date($selected, 'M - Y')}}</p>
                        </div>

                        <div class="page-title-right">
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
                                        <th>Employee</th>
                                        <th>Employee ID</th>
                                        <th>Target</th>
                                        <th>Achivement</th>
                                        <th>Percentage</th> 
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
                                                    $my_all_employee = my_all_employee($data->assign_to);
                                                 
                                                    $achive = \App\Models\Deposit::whereNotNull('approve_by') 
                                                                ->whereMonth('created_at', date('m'))
                                                                ->whereYear('created_at', date('Y'))
                                                                ->whereHas('customer', function($q) use($my_all_employee){
                                                                    $q->whereIn('ref_id', $my_all_employee);
                                                                }) 
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
    <script>
        var title = $('.page-title-box').find('h4').text();
        var Period = $('.page-title-box').find('p').text();;
    </script>
    @include('includes.data_table')
    <script>
        getDateRange('duration') 
    </script>
@endsection