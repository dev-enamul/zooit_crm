@extends('layouts.dashboard')
@section('title',"Profile") 
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
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="card"> 
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
                                                if(!isset($user) && empty($user)){
                                                    dd($employee);
                                                }
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
                                                <a href="{{route('profile.hierarchy.tree',[encrypt($user_id),'employee'=> encrypt($user->id)])}}" style="{{!empty($next_employees)?'background:#ddd':''}}">
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
    </div>  

    @include('includes.footer')
</div>
 
@endsection 
 
@section('script')
  
@endsection