@extends('layouts.dashboard')
@section('title','Special Offer Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$data->title}} Update</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a class="btn btn-secondary" href="{{route('special-commission.index')}}">
                                    <span><i class="mdi mdi-keyboard-backspace"></i> Back</span>
                                </a>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <form action="{{route('special-commission.update',$data->id)}}" method="post">
                            @csrf 
                            @method('PUT')
                            <div class="card-body"> 
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Offer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" id="title" value="{{$data->title}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control datepicker w-100" id="start_date" value="{{$data->start_date}}" name="start_date" type="text"/>   
                                        </div>
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input class="form-control datepicker w-100" id="end_date" value="{{$data->end_date}}" name="end_date" type="text"/>   
                                        </div>
                                    </div>  
                                    @foreach ($data->special_commissions as $key => $item)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="commission_{{$item->id}}" class="form-label">{{$item->commission_id->title}}</label>
                                                <input type="hidden" name="commission_id[]" value="{{$item->id}}">
                                                <input type="number" name="commission[]" class="form-control" step="any" id="commission_{{$item->id}}" value="{{$item->commission}}">  
                                            </div>
                                        </div> 
                                    @endforeach 
                                </div>  
                            </div>

                            <div class="card-footer">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                                    <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                                </div> 
                            </div> 
                        </form>

                    </div> 
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>  

    @include('includes.footer') 

</div>
@endsection 

@section('script')
    
@endsection