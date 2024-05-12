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
                        <p class="d-none">{{auth()->user()->name}} [{{auth()->user()->user_id}}]</p> 
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="a3">
                        <input type="hidden" id="fontSize" value="7"> 

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
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>S/N</th>
                                        <th>Action</th>
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
                                    @foreach ($datas as $key => $data)
                                    <tr> 
                                        <td>{{++$key}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    
                                                    <img class="rounded avatar-2xs p-0" src="{{$data?->assignTo?->image()}}">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    <a class="dropdown-item" href="{{route('assign.field.target',['id'=>$data->id])}}">Edit</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><a class="text-dark" href="{{route('my.field.target', ['month'=>urldecode($selected),'employee'=>encrypt($data->assignTo->id)])}}">{{@$data->assignTo->name}} [{{@$data->assignTo->user_id}}]</a> </td>  
                                        
                                        @php 
                                            $user = App\Models\User::find($data->assignTo->id);
                                            $my_all_employee = json_decode($user->user_employee);
                                            $user = $data->assignTo;
                                        @endphp 
                                        
                                        <td class="align-middle">
                                            {{$user->freelanecr_achive($selected,$my_all_employee)}} / {{$data->freelancer}}
                                        </td>  
                                        <td class="align-middle">
                                            {{$user->customer_achive($selected,$my_all_employee)}} /{{$data->freelancer}}
                                         </td>  
                                         <td class="align-middle">{{$user->prospecting_achive($selected,$my_all_employee)}} / {{$data->prospecting}}</td>  
                                        <td class="align-middle">{{$user->cold_calling_achive($selected,$my_all_employee)}} / {{$data->cold_calling}}</td>  
                                        <td class="align-middle">{{$user->lead_achive($selected,$my_all_employee)}} / {{$data->lead}}</td>  
                                        <td class="align-middle">{{$user->lead_analysis_achive($selected,$my_all_employee)}} / {{$data->lead_analysis}}</td>  
                                        <td class="align-middle">{{$user->presentation_achive($selected,$my_all_employee)}} / {{$data->project_visit}}</td>  
                                        <td class="align-middle">{{$user->visit_analysis_achive($selected,$my_all_employee)}} / {{$data->project_visit_analysis}}</td>  
                                        <td class="align-middle">{{$user->followup_achive($selected,$my_all_employee)}} / {{$data->follow_up}}</td>  
                                        <td class="align-middle">{{$user->followup_analysis_achive($selected,$my_all_employee)}} / {{$data->follow_up_analysis}}</td>  
                                        <td class="align-middle">{{$user->negotiation_achive($selected,$my_all_employee)}} / {{$data->negotiation}}</td>  
                                        <td class="align-middle">{{$user->negotiation_analysis_achive($selected,$my_all_employee)}} / {{$data->negotiation_analysis}}</td>
                                    </tr>
                                @endforeach 

                                    {{-- @foreach ($datas as $key => $data)
                                        <tr> 
                                            <td>{{++$key}}</td>
                                            <td><a href="{{route('my.field.target', ['month'=>urldecode($selected),'employee'=>encrypt($data->assign_to)])}}">{{@$data->assignTo->name}} [{{@$data->assignTo->user_id}}]</a> </td>  
                                            @php
                                                $user = $data->assignTo;
                                            @endphp
                                            <td class="align-middle">{{$user->freelanecr_achive($selected)}} / {{$data->freelancer}}</td>  
                                            <td class="align-middle">{{$user->customer_achive($selected)}} / {{$data->customer}}  </td>  
                                            <td class="align-middle">{{$user->prospecting_achive($selected)}} / {{$data->prospecting}}</td>  
                                            <td class="align-middle">{{$user->cold_calling_achive($selected)}} / {{$data->cold_calling}}</td>  
                                            <td class="align-middle">{{$user->lead_achive($selected)}} / {{$data->lead}}</td>  
                                            <td class="align-middle">{{$user->lead_analysis_achive($selected)}} / {{$data->lead_analysis}}</td>  
                                            <td class="align-middle">{{$user->presentation_achive($selected)}} / {{$data->project_visit}}</td>  
                                            <td class="align-middle">{{$user->visit_analysis_achive($selected)}} / {{$data->project_visit_analysis}}</td>  
                                            <td class="align-middle">{{$user->followup_achive($selected)}} / {{$data->follow_up}}</td>  
                                            <td class="align-middle">{{$user->followup_analysis_achive($selected)}} / {{$data->follow_up_analysis}}</td>  
                                            <td class="align-middle">{{$user->negotiation_achive($selected)}} / {{$data->negotiation}}</td>  
                                            <td class="align-middle">{{$user->negotiation_analysis_achive($selected)}} / {{$data->negotiation_analysis}}</td>   
                                        </tr>
                                    @endforeach  --}}
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
@endsection 

@section('script')
 @include('includes.data_table')
@endsection