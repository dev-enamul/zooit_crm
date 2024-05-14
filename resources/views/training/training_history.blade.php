@extends('layouts.dashboard')
@section('title','Training History')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Training History</h4>

                        <div class="page-title-right">
                            <form method="get">
                                <div class="input-group">  
                                    <input class="form-control" name="month" value="{{$date}}" id="filter_input" type="month" />   
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
                            <div class="table-box">
                                <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr> 
                                            <th class="text-center">Action</th> 
                                            <th class="text-center">S/L</th>
                                            <th class="text-center">Date Time</th>
                                            <th>Title</th>  
                                            <th>Created By</th>
                                            <th>Seat</th>
                                            <th>Trainer</th> 
                                            <th>Attendance</th>  
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($datas as $key =>  $data)
                                            <tr> 
                                                <td class="text-center align-middle"> 
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-animated">
                                                            <a class="dropdown-item" href="{{route('training.show',$data->id)}}">View</a>  
                                                            <a class="dropdown-item" href="{{route('training.edit',$data->id)}}">Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('training.destroy',$data->id) }}')">Delete</a>   
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">{{++$key}}</td> 
                                                <td class="text-center align-middle">
                                                    {{get_date($data->date)}} <br> 
                                                    <span class="badge badge-label-primary"> {{get_date($data->time,'h:i A')}} </span>
                                                        {{-- {{ \Carbon\Carbon::createFromFormat('H:i:s', $data->time)->format('h:i A') }} --}}
                                                </td>
                                                
                                                <td class="align-middle">{{$data->category->title}}</td> 
                                                <td class="align-middle">{{$data->createdBy->name}} [{{$data->createdBy->user_id}}]</td>
                                                <td class="align-middle">{{$data->seat}}</td>
                                                <td class="align-middle">
                                                    <div class="avatar-group">
                                                        @php 
                                                            $trainers = json_decode($data->trainer); 
                                                        @endphp 
    
                                                        @foreach ($trainers as $trainer)
                                                            @php
                                                                $trainer = App\Models\User::select('name','id')->where('id',$trainer)->first();
                                                            @endphp
                                                            <div class="avatar avatar-circle avatar-circle-sm">
                                                                <a target="blank" href="{{route('profile',encrypt($trainer->id))}}" data-bs-toggle="tooltip" title="{{$trainer->name}}">
                                                                    <img src="{{$trainer->image()??""}}"  class="avatar-2xs">
                                                                </a> 
                                                            </div> 
                                                        @endforeach
                                                        
                                                    </div>
                                                </td>  
    
                                                <td class="align-middle"> 
                                                    <div class="avatar-group">
                                                        @foreach ($data->attendance as $key => $attendance)
                                                            @if ($key < 5)
                                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                                    <a href="" data-bs-toggle="tooltip" title="{{$attendance->user->name??null}}">
                                                                        <img src="{{$attendance->user->image()??null}}" alt="{{$attendance->user->name??null}}" class="avatar-2xs cursor-pointer">
                                                                    </a>
                                                                </div> 
                                                            @endif 
                                                        @endforeach
                                                       
                                                        @if (count($data->attendance) > 5)
                                                            <div class="avatar avatar-circle avatar-circle-sm">
                                                                <a href="">
                                                                    +{{count($data->attendance)-5}}
                                                                </a> 
                                                            </div> 
                                                        @endif 
                                                    </div>
                                                </td>
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
@endsection