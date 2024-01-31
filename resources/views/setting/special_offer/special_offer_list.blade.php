@extends('layouts.dashboard')
@section('title','Special Offer')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Special Offer</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i>Add Offer</span>
                                </button> 
                            </ol>
                        </div> 
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                             
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Month</th> 
                                        <th>Bank Day</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"onclick="deleteItem('{{ route('bank-day.destroy',$item->id) }}')">Delete</a>  
                                                    </div>
                                                </div> 
                                            </td> 
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($item->month, 'M-Y')}}</td> 
                                            <td>
                                                @foreach(json_decode($item->bank_day) as $bank_day)
                                                <div class="btn btn-sm btn-primary mb-2">{{$bank_day}}</div>
                                                @endforeach
                                            </td>
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
    @include('includes.footer')
</div>
 
@endsection 

 
