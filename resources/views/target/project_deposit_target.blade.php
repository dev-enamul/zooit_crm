@extends('layouts.dashboard')
@section('title',"Deposit Target Asign")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target Asign </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target Asign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12"> 
                    <form class="needs-validation" method="POST" action="{{route('deposit.target.save')}}" novalidate> 
                        @csrf 

                        <div class="row">
                            <div class="col-md-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-hospital-building fs-24"></i> 
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted fw-medium mb-2">New Unit</p>
                                                <h4 class="mb-0" id="total_new_unit">0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-hospital-building fs-24"></i> 
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted fw-medium mb-2">Existing Unit</p>
                                                <h4 class="mb-0" id="total_existing_unit">0</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-credit-card fs-24"></i> 
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted fw-medium mb-2">New Deposit</p>
                                                <h4 class="mb-0"><span id="total_new_deposit">0</span> Tk</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-3"> 
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                    <span class="avatar-title">
                                                        <i class="mdi mdi-credit-card fs-24"></i> 
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="text-muted fw-medium mb-2">Existing Deposit</p>
                                                <h4 class="mb-0"><span id="total_existing_deposit">0</span> Tk</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="row"> 
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="assign_to" class="form-label">Assign To <span class="text-danger">*</span></label>
                                            <select class="select2" search name="assign_to" id="assign_to" required>
                                                <option value="">Select Employee</option>
                                                @foreach ($employees as $key => $item)
                                                    <option  value="{{$item->id}}">{{$item->name}} [{{$item->user_id}}]</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="month" class="form-label">Month<span class="text-danger">*</span></label>
                                            <input type="month" class="form-control" id="month" name="month" value="{{ date('Y-m') }}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div> 
                            @foreach ($projects as $item) 
                                <input type="hidden" name="project_id[]" value="{{$item->id}}"> 
 
                                <div class="card-body"> 
                                    <div class="row">
                                        <div class="rich-list-item pt-0">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs">
                                                    <div class=""><img src="assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs"></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">{{$item->name}}</h4>
                                                <p class="rich-list-subtitle mb-0">{{$item->address}}</p>
                                            </div>
                                            <div class="rich-list-append"><a href="{{route('sold.unsold',$item->id)}}" class="btn btn-sm btn-label-primary">Profile</a></div>
                                        </div>
                                        <hr>   
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="new_unit_{{$item->id}}" class="form-label">New Unit</label>
                                                <input type="number" name="new_unit[]" id="new_unit_{{$item->id}}" min="0" class="form-control" placeholder="0"> 
                                            </div>
                                        </div> 

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="new_deposit_{{$item->id}}" class="form-label">New Deposit</label>
                                                <input type="number" name="new_deposit[]" id="new_deposit_{{$item->id}}" min="0" class="form-control" placeholder="0"> 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="existing_unit_{{$item->id}}" class="form-label">Existing Unit</label>
                                                <input type="number" name="existing_unit[]" id="existing_unit_{{$item->id}}" min="0" class="form-control" > 
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="existing_deposit_{{$item->id}}" class="form-label">Existing Deposit</label>
                                                <input type="number" name="existing_deposit[]" id="existing_deposit_{{$item->id}}" min="0" class="form-control"> 
                                            </div>
                                        </div> 
                                    </div>  
                                </div> 
                            @endforeach 
                            <div class="card-footer">
                                <div class="text-end">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger refresh_btn" type="submit"><i class="mdi mdi-refresh"></i> Reset</button>
                                </div> 
                            </div> 
                        </div>    
                    </form>
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
{{-- assign_to change call ajax  --}}
<script>
    $(document).on('change','#assign_to',function(){
        var assign_to = $(this).val(); 
        var month = $('#month').val();
        $.ajax({
            url: '{{ route('employee.projects') }}',
            type: 'get',
            data: {employee_id: assign_to, month:month},
            success: function(response) { 
                response.forEach(element => { 
                    $('#new_unit_'+element.project_id).val(element.new_unit);
                    $('#new_deposit_'+element.project_id).val(element.new_deposit);
                    $('#existing_unit_'+element.project_id).val(element.existing_unit);
                    $('#existing_deposit_'+element.project_id).val(element.existing_deposit); 
                });
            }
        });
    }); 

    $(document).on('change', 'input[type="number"]', function() {
    var total_new_unit = 0;
    var total_existing_unit = 0;
    var total_new_deposit = 0;
    var total_existing_deposit = 0;

    $('input[name^="new_unit"]').each(function() {
        total_new_unit += parseInt($(this).val()) || 0;
    });

    $('input[name^="existing_unit"]').each(function() {
        total_existing_unit += parseInt($(this).val()) || 0;
    });

    $('input[name^="new_deposit"]').each(function() {
        total_new_deposit += parseInt($(this).val()) || 0;
    });

    $('input[name^="existing_deposit"]').each(function() {
        total_existing_deposit += parseInt($(this).val()) || 0;
    });

    $('#total_new_unit').text(total_new_unit);
    $('#total_existing_unit').text(total_existing_unit);
    $('#total_new_deposit').text(total_new_deposit);
    $('#total_existing_deposit').text(total_existing_deposit);
});

</script>
@endsection