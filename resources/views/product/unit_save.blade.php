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
                                <input type="hidden" name="project_id" value="{{$project_unit->id??0}}">                                
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

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lottery_price" class="form-label">Regular Price<span class="text-danger">*</span></label>
                                            <input type="number" name="lottery_price" class="form-control reset-data" placeholder="Lottery Select Price" required value="{{ old('lottery_price', isset($project_unit) ? $project_unit->lottery_price : '') }}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="on_choice_price" class="form-label">On Choice Price<span class="text-danger">*</span></label>
                                            <input type="number" name="on_choice_price" class="form-control reset-data" placeholder="On Choice Price" required value="{{ old('on_choice_price', isset($project_unit) ? $project_unit->on_choice_price : '') }}">
                                            <div class="invalid-feedback">
                                                This field is required.
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
 