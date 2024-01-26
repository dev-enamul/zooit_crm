@extends('layouts.dashboard')
@section('title', $title)

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            @if(isset($project_unit))
                                Project Unit Edit
                            @else
                                Project Unit Entry
                            @endif
                        </h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    @if(isset($project_unit))
                                        Project Unit Edit
                                    @else
                                        Project Unit Entry
                                    @endif
                                </li>
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
                            <form id="unitSave" action="{{ isset($project_unit) ? route('unit.save', $project_unit->id) : route('unit.save') }}" method="POST" >
                                <input type="hidden" id="is_update" value="{{isset($project_unit) ? $project_unit->id : ''}}">
                                @csrf                                 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="project" class="form-label">Product <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="project" id="project" required>
                                            <option data-display="Select a product *" value="">
                                                Select a Product
                                            </option>
                                            @isset($products)
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" {{ old('project', isset($project_unit) ? $project_unit->project_id : null) == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('product'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('product') }}
                                            </span>
                                        @endif
                                    </div>   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_name" class="form-label">Unit Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control reset-data" id="unit_name" placeholder="Unit name" value="{{ isset($project_unit) ? $project_unit->name : old('name')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="floor" class="form-label">Floor Number <span class="text-danger">*</span></label>
                                            <input type="text" name="floor" class="form-control reset-data" id="floor" placeholder="Floor number" value="{{ isset($project_unit) ? $project_unit->floor : old('floor')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
 
                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Unit Type <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="unit" id="unit" required>
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($project_unit) ? $project_unit->unit_id : null) == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('unit'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('unit') }}
                                            </span>
                                        @endif
                                    </div>  

                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">Unit Category Type <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="category" id="category" required>
                                            <option data-display="Select a category *" value="">
                                                Select a category
                                            </option>
                                            @isset($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('unit', isset($project_unit) ? $project_unit->unit_category_id : null) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('category'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('category') }}
                                            </span>
                                        @endif
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control reset-data" id="description" rows="2" name="description">{{ old('description', isset($project_unit) ? $project_unit->description : '') }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="container" id="unit_prices">
                                        <div class="row">
                                            @if(isset($project_unit) && $project_unit->unitPrices->isNotEmpty())
                                                @foreach($project_unit->unitPrices as $index => $unitPrice)
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="payment_duration[]" class="form-label">Payment Duration Month<span class="text-danger">*</span></label>
                                                            <input type="number" name="payment_duration[]" class="form-control reset-data" placeholder="Payment Duration Month" required value="{{ $unitPrice->payment_duration }}">
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="on_choice_price[]" class="form-label">On Choice Price<span class="text-danger">*</span></label>
                                                            <input type="number" name="on_choice_price[]" class="form-control reset-data" placeholder="On Choice Price" required value="{{ $unitPrice->on_choice_price }}">
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="lottery_price[]" class="form-label">Lottery Select Price<span class="text-danger">*</span></label>
                                                            <input type="number" name="lottery_price[]" class="form-control reset-data" placeholder="Lottery Select Price" required value="{{ $unitPrice->lottery_price }}">
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                    @if($index < $project_unit->unitPrices->count() - 1)
                                                        <div class="col-md-12"> </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="payment_duration[]" class="form-label">Payment Duration Month<span class="text-danger">*</span></label>
                                                        <input type="number" name="payment_duration[]" class="form-control reset-data" placeholder="Payment Duration Month" required value="{{ old('payment_duration.0') }}">
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="on_choice_price[]" class="form-label">On Choice Price<span class="text-danger">*</span></label>
                                                        <input type="number" name="on_choice_price[]" class="form-control reset-data" placeholder="On Choice Price" required value="{{ old('on_choice_price.0') }}">
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="lottery_price[]" class="form-label">Lottery Select Price<span class="text-danger">*</span></label>
                                                        <input type="number" name="lottery_price[]" class="form-control reset-data" placeholder="Lottery Select Price" required value="{{ old('lottery_price.0') }}">
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                    
                                            <div class="text-center">
                                                <button class="btn btn-primary add-row" type="button">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
</div>
 
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on("click", ".add-row", function() {
                var newRow = $("<div class='row'></div>");
                var cols = "";
                var is_update = $("#is_update").val();
    
                cols += "<div class='col-md-4'><input type='number' name='payment_duration[]' class='form-control reset-data' placeholder='Payment Duration Month' required value='{{ old('payment_duration.*') }}'></div>";
                cols += "<div class='col-md-4'><input type='number' name='on_choice_price[]' class='form-control reset-data' placeholder='On Choice Price' required value='{{ old('on_choice_price.*') }}'></div>";
                cols += "<div class='col-md-4'><input type='number' name='lottery_price[]' class='form-control reset-data' placeholder='Lottery Select Price' required value='{{ old('lottery_price.*') }}'></div>";
                cols += "<div class='text-center'><button class='btn btn-danger remove-row' type='button'>-</button></div>";
    
                newRow.append(cols);
                $(".container .row:last-child").after(newRow);
            });
    
            $("#unitSave").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        setTimeout(function() {
                            toastr.success(response.success);
                        }, 100);

                        if (is_update == null || is_update == '') {
                            resetData();
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            updateUnitPrice(errors);
    
                            $.each(errors, function(key, value) {
                                toastr.error(value[0]);
                            });
                        } else {
                            console.error(xhr.responseText);
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });
    
            $(".container").on("click", ".remove-row", function() {
                $(this).closest(".row").remove();
            });
    
            function resetData() {
                $(".reset-data").val('');
            }
    
            function updateUnitPrice(errors) {
                $.each(errors, function(key, value) {
                    var inputName = key.replace('[]', '');
                    $("#unit_prices input[name='" + inputName + "']").each(function() {
                        $(this).addClass('is-invalid').next('.invalid-feedback').text(value[0]);
                    });
                });
            }
        });
    </script>
 @endsection