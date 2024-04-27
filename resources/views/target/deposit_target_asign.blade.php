@extends('layouts.dashboard')
@section('title',"Deposit Target Assign")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target Assign</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target Assign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header text-primary">
                            <div class="card-icon">
                                <i class="fas fa-building fs-14"></i>
                            </div>
                            <h4 class="card-title mb-0">{{@$target_project->project->name}}</h4> 
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div class="">
                                            <p class="text-primary text-truncate mb-2"> New Unit</p>
                                            <h5 class="mb-0" id="total_new_unit">{{$target_project->new_unit}}</h5>
                                        </div> 
                                        <div class="text-primary float-end">
                                            {{-- <i class="fas fa-check"></i> --}}
                                            <i class="mdi mdi-menu-up"> </i><span id="remain_new_unit">{{$target_project->new_unit}}</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Existing Unit</p>
                                            <h5 class="mb-0" id="total_ex_unit">{{$target_project->existing_unit}}</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i><span id="remain_ex_unit">{{$target_project->existing_unit}}</span>
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">New Deposit</p>
                                            <h5 class="mb-0" id="total_new_deposit">{{get_price($target_project->new_total_deposit)}}</h5>
                                        </div> 
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i><span id="remain_new_deposit">{{get_price($target_project->new_total_deposit)}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Existing Deposit</p>
                                            <h5 class="mb-0" id="total_ex_deposit">{{get_price($target_project->existing_deposit)}}</h5>
                                        </div> 

                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i><span id="remain_ex_deposit">{{get_price($target_project->existing_deposit)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <form class="needs-validation" novalidate>
                        @foreach ($employees as $data)
                            <div class="card"> 
                                <div class="card-body"> 
                                        <div class="row">
                                            <div class="rich-list-item pt-0">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="{{ $data->image() }}" alt="Avatar image" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">{{$data->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">{{$data->user_id}}</p>
                                                </div>
                                                {{-- <div class="rich-list-append"><button class="btn btn-sm btn-label-primary">Profile</button></div> --}}
                                            </div>
                                            <hr>   
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_unit_{{$data->id}}" class="form-label">New Unit</label>
                                                    <input type="number" name="new_unit[]" id="new_unit_{{$data->id}}" min="0" class="form-control new-unit" placeholder="0"> 
                                                </div>
                                            </div> 
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_deposit_{{$data->id}}" class="form-label">New Deposit</label>
                                                    <input type="number" name="new_deposit[]" id="new_deposit_{{$data->id}}" min="0" class="form-control new-deposit" placeholder="0"> 
                                                </div>
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exsiting_unit_{{$data->id}}" class="form-label">Existing Unit</label>
                                                    <input type="number" name="existing_unit[]" id="exsiting_unit_{{$data->id}}" min="0" class="form-control ex-unit" placeholder="0"> 
                                                </div>
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exsiting_deposit_{{$data->id}}" class="form-label">Existing Deposit</label>
                                                    <input type="number" name="existing_deposit[]" id="exsiting_deposit_{{$data->id}}" min="0" class="form-control ex-deposit" placeholder="0"> 
                                                </div>
                                            </div> 
                                        </div>  
                                </div> 
                            </div>  
                        @endforeach  

                    <div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
                </div>
                <!-- end col -->

            </div> 
        </div>  
    </div>
l
  @include('includes.footer')

</div>
@endsection 

@section('script')
<script>
    $(document).ready(function () { 
        var new_unit = 0;
        var new_deposit = 0;
        var ex_unit = 0;
        var ex_deposit = 0; 

        var total_new_unit = $('#total_new_unit').text();
        var total_ex_unit = $('#total_ex_unit').text();
        var total_new_deposit = $('#total_new_deposit').text();
        var total_ex_deposit = $('#total_ex_deposit').text();

        total_new_unit = parseFloat(total_new_unit.replace(/[^0-9.]/g, '')) || 0;
        total_ex_unit = parseFloat(total_ex_unit.replace(/[^0-9.]/g, '')) || 0;
        total_new_deposit = parseFloat(total_new_deposit.replace(/[^0-9.]/g, '')) || 0;
        total_ex_deposit = parseFloat(total_ex_deposit.replace(/[^0-9.]/g, '')) || 0; 

        var remain_new_unit = total_new_unit;
        var remain_ex_unit = total_ex_unit;
        var remain_new_deposit = total_new_deposit;
        var remain_ex_deposit = total_ex_deposit; 

        function calculateSum(inputs) {
            var sum = 0;
            inputs.each(function () {
                sum += parseFloat($(this).val()) || 0; 
            });
            return sum;
        } 

        function updateTotal(className) {
            var total = calculateSum($(className));
            return total;  
        }  

        $('.new-unit').on('input',function(){
            new_unit = updateTotal('.new-unit'); 
            calculateTotal();
        }); 

        $('.new-deposit').on('input',function(){
            new_deposit = updateTotal('.new-deposit'); 
            calculateTotal();
        }); 

        $('.ex-unit').on('input',function(){
            ex_unit = updateTotal('.ex-unit'); 
            calculateTotal();
        }); 
        
        $('.ex-deposit').on('input',function(){
            ex_deposit = updateTotal('.ex-deposit'); 
            calculateTotal();
        }); 

        function calculateTotal(){  
             remain_new_unit = total_new_unit - parseInt(new_unit);
             remain_ex_unit = total_ex_unit - ex_unit;
             remain_new_deposit = total_new_deposit - new_deposit;
             remain_ex_deposit = total_ex_deposit - ex_deposit;

            $('#remain_new_unit').text(remain_new_unit);
            $('#remain_ex_unit').text(remain_ex_unit);
            $('#remain_new_deposit').text(remain_new_deposit);
            $('#remain_ex_deposit').text(remain_ex_deposit); 
        }

        $('form').submit(function (event) { 
            if (remain_new_unit > 0) {
                event.preventDefault(); 
                Toast.fire({ icon: "warning", title: 'You have remain '+remain_new_unit+' new units' }); 
            }

            if (remain_ex_unit > 0 ) {
                event.preventDefault(); 
                Toast.fire({ icon: "warning", title: 'You have remain '+remain_ex_unit+' Existing units' }); 
            }

            if (remain_new_deposit > 0 ) {
                event.preventDefault(); 
                Toast.fire({ icon: "warning", title: 'You have remain '+remain_new_deposit+' new Deposit' }); 
            }

            if (remain_ex_deposit > 0) {
                event.preventDefault(); 
                Toast.fire({ icon: "warning", title: 'You have remain '+remain_ex_deposit+' Existing Deposit' }); 
            }
        });

    });
</script>
@endsection