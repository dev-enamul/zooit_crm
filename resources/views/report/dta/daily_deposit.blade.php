@extends('layouts.dashboard')
@section('title',"Daily Total Deposit")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-sm-0">Daily Deposit Report</h4> 
                            <p class="d-none">{{get_date($startDate)}} - {{get_date($endDate)}}</p>
                        </div>

                        <div class="">   
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <input class="form-control" id="date" name="date" default="This Month" type="text" value="" /> 
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
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover align-middle table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th>SL.</th>
                                        <th>Date</th>
                                        <th>Regular Deposit</th>
                                        @foreach ($deposit_categories as $category)
                                            <th>{{ $category->name }}</th> 
                                        @endforeach 
                                        <th>Total Cash</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($daily_deposits as $index  => $deposit)
                                    <tr class=""> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ get_date($index) }}</td>
                                        <td>{{ get_price($deposit->where('deposit_category_id',null)->sum('amount')) }}</td>
                                        @foreach ($deposit_categories as $category) 
                                            <td>{{get_price($deposit->where('deposit_category_id',$category->id)->sum('amount')) }}</td>
                                        @endforeach 
                                        <td>{{ get_price($deposit->sum('amount')) }}</td>
                                    </tr>
                                    @endforeach 
                                </tbody>
                                <tfoot>
                                    <tr class="align-middle"> 
                                        <th></th>
                                        <th>Total</th>
                                        <th>{{ get_price($total_deposit->where('deposit_category_id',null)->sum('amount'))}}</th>
                                        @foreach ($deposit_categories as $category)
                                            <th>{{ get_price($total_deposit->where('deposit_category_id',$category->id)->sum('amount'))}}</th> 
                                        @endforeach 
                                        <th>{{get_price($total_deposit->sum('amount'))}}</th>
                                    </tr>
                                </tfoot>
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
 
@endsection

@section('script') 
<script>
    var title = $('.page-title-box').find('h4').text();
    var Period = $('.page-title-box').find('p').text();
    getDateRange('date');
</script>
    @include('includes.data_table')
    
@endsection