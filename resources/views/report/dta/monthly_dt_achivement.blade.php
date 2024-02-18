@extends('layouts.dashboard')
@section('title',"Deposit Target Achivement")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-sm-0">
                                @if ($is_all_designation)
                                    All Employee
                                @else
                                    @foreach ($selected_designation as  $designation)
                                        {{$designation->title}} @if(!$loop->last) , @endif
                                    @endforeach 
                                @endif
                            Wise Deposit Report</h4>
                            <p class="d-none">{{get_date($date,'M-Y')}}</p>
                        </div>

                        <div class="d-flex">   
                            <a class="btn btn-primary me-1" href="{{route(Route::currentRouteName())}}"><i class="mdi mdi-refresh"></i> </a>
                            
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button> 
                        </div>

                    </div>
                </div>
            </div>

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover align-middle text-center table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th>SL.</th>
                                        <th>Name of Employee</th>
                                        <th>Total Target</th>
                                        <th>Regolar Deposit</th>
                                        @foreach ($deposit_categories as $deposit_category)
                                            <th>{{ $deposit_category->name }}</th> 
                                        @endforeach  
                                        <th>Total Cash Collection</th>
                                        <th>T & A %</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                        
                                    @endphp 
                                    
                                    @foreach ($selected_designation as  $designation)
                                        @if (isset($designation->employees) && count($designation->employees) > 0)
                                            @php
                                                $designation_target = 0; 
                                                foreach($deposit_categories as $deposit_category) {
                                                    $designation_deposit[$deposit_category->id] = 0;
                                                }
                                                $designation_deposit['regular'] = 0;
                                            @endphp
                                            @foreach ($designation->employees as $key=> $employee)
                                                <tr class=""> 
                                                    <td>{{ $key+ 1}}</td>
                                                    <td>{{$employee->user->name}}</td>
                                                    @php
                                                        $target = clone $deposit_target;
                                                        $total_target = $target->where('assign_to', $employee->id)->sum(function ($item) {
                                                                return $item->new_total_deposit + $item->existing_total_deposit;
                                                            });
                                                            $designation_target += $total_target;
                                                    @endphp
                                                    <td>{{get_price($total_target)}}</td>
                                                    @php 
                                                        $my_all_employee = my_all_employee($employee->id);
                                                        $deposit = App\Models\Deposit::where('approve_by', '!=', null)
                                                            ->whereHas('customer', function ($query) use ($my_all_employee) {
                                                                $query->WhereIn('ref_id', $my_all_employee);
                                                            }) 
                                                            ->whereMonth('date', $date->format('m')) 
                                                            ->whereYear('date', $date->format('Y'));
                                                    @endphp 
                                                    @php
                                                        $clone_deposit = clone $deposit;
                                                        $price = $clone_deposit->where('deposit_category_id', null)->sum('amount');
                                                        $designation_deposit['regular'] = $designation_deposit['regular'] + $price;
                                                    @endphp 
                                                    <td>{{get_price($price)}}</td>
                                                    @foreach ($deposit_categories as $deposit_category)  
                                                        @php
                                                            $clone_deposit = clone $deposit; 
                                                            $price = $clone_deposit->where('deposit_category_id', $deposit_category->id)->sum('amount');
                                                            $designation_deposit[$deposit_category->id] = $designation_deposit[$deposit_category->id] + $price;
                                                        @endphp
                                                        <td>{{get_price($price)}}</td>  
                                                    @endforeach  

                                                    @php
                                                        $clone_deposit = clone $deposit; 
                                                        $total_deposit = $clone_deposit->sum('amount');
                                                    @endphp 

                                                    <td>{{get_price($total_deposit)}} </td>
                                                    <td>{{get_percent($total_deposit,$total_target)}}</td> 
                                                </tr> 
                                            @endforeach    
                                            <tr>  
                                            
                                                <td></td>
                                                <td><b>{{$designation->title}} Report</b></td>
                                                <td><b>{{get_price($designation_target)}}</b></td> 
                                                <td>{{get_price($designation_deposit['regular'])}}</td>
                                                 @foreach ($deposit_categories as $deposit_category)  
                                                    <td><b>{{get_price($designation_deposit[$deposit_category->id])}}</b></td> 
                                                @endforeach  
                                                <td>{{get_price(array_sum($designation_deposit))}}</td>
                                                <td>{{get_percent(array_sum($designation_deposit),$designation_target)}}</td> 
                                           
                                            </tr> 
                                        @endif 
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

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
       <form action="" method="get">
            <div class="row">    
                
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month </label>
                        <input class="form-control" id="month" name="month" type="month" value="{{ $date->format('Y-m') }}"/>   
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="week" class="form-label">Week </label>
                        <select name="week" class="select2" id=""> 
                            <option value="1">1st Week [1-7]</option>
                            <option value="2">2nd Week [8-14]</option>
                            <option value="3">3rd Week [15-21]</option>
                            <option value="4">4th Week [22-31]</option>
                            <option value="0" selected>Full Month</option>
                        </select>   
                    </div>
                </div> 

                <div class="col-md-12"> 
                    <div class="mb-3">
                        <label for="designation" class="form-label">Employee Position </label>
                        <select class="select2" multiple  name="designation[]" id="designation"> 
                            <option value="">All Designation</option>
                            @foreach ($designations as $designation) 
                                <option value="{{$designation->id}}">{{$designation->title}}</option>
                            @endforeach 
                        </select>  
                    </div>
                </div> 
                <div class="text-end ">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                </div>  
            </div>
       </form>
    </div>
</div>
@endsection

@section('script') 
    <script>
        // getDateRange('duration')
    </script>
@endsection