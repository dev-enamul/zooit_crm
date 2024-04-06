@extends('layouts.dashboard')
@section('title',"Employee Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('user.permission.update')}}" method="POST">
                            @csrf   
                            <input type="hidden" name="user_id" value="{{$employee->id}}">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <div class="mb-1">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAll" > 
                                        <label for="selectAll">Check All</label>
                                    </div> 
                                </div>
                                {{-- <h4 class="mb-sm-0" id="#swal-11">{{$employee->name}} Permission</h4>   --}}
                                <div class="">
                                    <div class="btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                            <span><i class="fas fa-save"></i> Update</span>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body"> 
                                <div class="row">
                                    @foreach ($datas as $data)
                                        <div class="col-md-4 mb-4"> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$data->id}}" name="permission[]" id="permission-{{$data->id}}" {{in_array($data->id,$selected)?"checked":""}}>
                                                 <label class="form-check-label" for="permission-{{$data->id}}"> {{$data->name}}</label>
                                            </div> 
                                        </div> 
                                    @endforeach   
                                </div> 
                            </div>
                        </form> 
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

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
        $(document).ready(function () { 
            $('#selectAll').click(function () {
                $(':checkbox').prop('checked', this.checked);
            });
        });
    </script>
@endsection

 
 