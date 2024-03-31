@extends('layouts.dashboard') 
@section('title','Task Complete')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Asign Task List </h4>  
                        <p class="d-none">Date : {{get_date($selected_date)}}</p> 
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="a4">
                        <input type="hidden" id="fontSize" value="8"> 
                        <div class="page-title-right">
                            <form action="" method="get">
                                <div class="input-group">  
                                    <input class="form-control" type="date" value="{{$selected_date}}" name="date" />   
                                    <button class="btn btn-secondary" type="submit">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card"> 
                        <div class="card-body">
                           <div class="d-flex justify-content-between">    
                           </div>

                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>  
                                        {{-- <th>Action</th>  --}}
                                        <th>S/N</th> 
                                        <th>Date & Time</th>
                                        <th>Assign To</th> 
                                        <th>Particulars</th> 
                                        <th>Status</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $key => $data)
                                    <tr> 
                                        {{-- <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            @if ($data->status==0)
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="{{route('submit.task',$data->id)}}" >Delete</a> 
                                                    </div>
                                                </div> 
                                            @endif
                                           
                                        </td>   --}}
                                        <td>{{$key+1}}</td>
                                        <td>{{get_date($data->time)}} <span class="badge badge-primary">{{get_date($data->time,'g:i A')}}</span></td>  
                                        <td>{{@$data->taskModel->assignee->name}} [{{@$data->taskModel->assignee->user_id}}]</td>
                                        <td>{{$data->task}}</td>
                                        <td>
                                            @if($data->status==0)
                                                <span class="badge badge-warning">Pending</span>
                                            @else  
                                                <span  class="badge badge-success">Completed</span>
                                            @endif
                                        </td> 
                                    </tr>  
                                    @endforeach
                                </tbody>
                            </table>
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
@include('includes.data_table')
@endsection