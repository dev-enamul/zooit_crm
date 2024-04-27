@extends('layouts.dashboard') 
@section('title','Employee Tree') 
@section('style')  
<link rel="stylesheet" href="{{asset('assets/libs/tree/tree.css')}}" /> 
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
            .tree{
                overflow: none !important;
            } 
            a{
                color: #000 !important;
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
                        <div> 
                             @foreach ($reporting as $key => $val)
                             @php
                                 $user = user_info($val);
                             @endphp 
                                @if ($key!=0)
                                    /
                                @endif
                                <a href="{{route('employees.hierarchy2',['employee'=> encrypt($user->id)])}}">{{$user->user_id }}</a>   
                             @endforeach                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">  
                    <div class="card">
                       <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 class="card-title text-center">{{$employee->name}} [{{$employee->user_id}}]</h4>
                            <div class="">   
                                <form action="" method="get" action="">
                                    <div class="input-group">  
                                        <select class="select2" search name="employee" id="employee" required>
                                            <option value="{{encrypt(auth()->user()->id)}}" selected="selected">{{Auth::user()->name}}</option>
                                        </select>
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </form> 
                            </div>
                       </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="tree">
                                    <ul>
                                        <li> <a href=""><img src="{{$employee->image()}}"><span>{{$employee->name}} <br> {{$employee->user_id}}</span></a>
                                        {{-- @include('includes.down_hierachy',[ 'depth' => 1])  --}} 

                                        <ul>
                                            @foreach ($my_emplyees as $employee) 
                                            @php
                                                $user = App\Models\User::find($employee);  
                                                $next_employees = my_employee($employee); 
                                                if(!empty($next_employees)){
                                                    $all_employee = json_decode($user->user_employee);
                                                    $employee = \App\Models\User::whereIn('id',$all_employee)->where('user_type',1)->count();
                                                    $freelancer = \App\Models\User::whereIn('id',$all_employee)->where('user_type',2)->count();
                                                }else{
                                                    $employee = 0;
                                                    $freelancer = 0;
                                                }
                                            @endphp
                                            <li>  
                                                <a href="{{route('employees.hierarchy2',['employee'=> encrypt($user->id)])}}" style="{{!empty($next_employees)?'background:#ddd':''}}">
                                                    <img src="{{@$user->image()}}">
                                                    <span>{{ @$user?->name }} <br>{{ @$user?->user_id }}  <br>  
                                                        Total Employee: {{ $employee }}
                                                        <br>  
                                                        Total Freelancer: {{ $freelancer }} </span> 
                                                </a>   
                                            </li> 
                                            @endforeach 
                                        </ul>
                                    </ul>
                                </div>
                            </div>
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
                    url: '{{ route('select2-employee-encode') }}',
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