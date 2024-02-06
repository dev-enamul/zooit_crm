@extends('layouts.dashboard')
@section('title','Assign Task')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Assign Target</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Assign Target</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form class="needs-validation" action="{{route('task.save')}}" method="post" novalidate>
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="assign_to" class="form-label">Task Asign To</label>
                                            <select class="select2" search id="assign_to" name="assign_to" required>
                                                <option value="">Select Employee</option> 
                                                @foreach ($employeies as $data)
                                                 <option value="{{$data->id}}">{{$data->name}}-{{$data->phone}}-{{$data->user_id}}</option>
                                                @endforeach 
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="date" name="date" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="time" class="form-label">Task Time</label>
                                                <input type="time" class="form-control" id="time" name="time[]" value="10:00" required>
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <label for="task" class="form-label">Task</label>
                                                <input type="text" name="task[]" class="form-control" id="task" required>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="text-center" >
                                        <button class="btn btn-primary" id="add-row" type="button">+</button>
                                    </div>
                                </div>
                                  
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
                <!-- end col -->

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
        $(document).ready(function(){
            $('#add-row').click(function(){
                var html = ` <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Submit Time</label>
                                        <input type="time" class="form-control" id="time" name="time[]" value="10:00" required>
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="task" class="form-label">Task</label>
                                        <div class="input-group">
                                            <input type="text" name="task[]" class="form-control" id="" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-danger close-button" type="button">X</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                `;
                $(this).parent().before(html);
            })

            $(document).on('click','.close-button',function(){
                $(this).closest('.row').remove();
            })

        document.getElementById('date').valueAsDate = new Date();
        }) 
    </script>
@endsection