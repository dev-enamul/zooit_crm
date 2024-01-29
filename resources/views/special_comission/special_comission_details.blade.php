@extends('layouts.dashboard')
@section('title','Bijoy Offer')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$data->title}} </h4> 
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
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           

                           <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr> 
                                    <th>S/N</th>
                                    <th>Profession Name</th> 
                                    <th>Commision</th> 
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach ($data->special_commissions as $key => $item)
                                    <tr> 
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->commission_id->title}}</td>  
                                        <th>{{$item->commission}}%</th> 
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