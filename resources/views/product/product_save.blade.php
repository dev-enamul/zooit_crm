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
                                @if(isset($product))
                                    Product Edit
                                @else
                                    Product Entry
                                @endif
                            </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">
                                        @if(isset($product))
                                            Product Edit
                                        @else
                                            Product Entry
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
                                @if(isset($product))
                                    <form action="{{route('product.save',$product->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                @else 
                                    <form action="{{route('product.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @endif 
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" class="form-control" id="first_name" placeholder="name" value="{{ isset($product) ? $product->name : old('name')}}" required>
                                                <div class="invalid-feedback">
                                                    This field is required.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Product Image</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                                @if (isset($product) && $product->images->isNotEmpty())
                                                    <img src="{{ asset('storage/' . $product->images->first()->name) }}" alt="" width="100" height="100">
                                                @endif
                                            </div>
                                        </div>
                                        
                                        @include('common.area', [
                                            'div'       => 'col-md-6',
                                            'mb'        => 'mb-3',
                                            'visible'   => ['division', 'district', 'upazila','union','village'],
                                            'required'  => [],
                                            'selected'  => $selected ?? null,
                                        ])

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="total_floor" class="form-label">Total Floor</label>
                                                <input type="number" name="total_floor" id="total_floor" class="form-control"  value="{{isset($product) ? $product->total_floor : old('total_floor')}}">  
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="google_map" class="form-label">Google Map Location</label>
                                                <input type="string" name="google_map" id="google_map" class="form-control" value="{{isset($product) ? $product->google_map : old('google_map')}}">  
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea class="form-control" id="address" rows="2" name="address">{{isset($product) ? $product->address : old('address')}}</textarea> 
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" rows="2" name="description">{{isset($product) ? $product->description : old('description')}}</textarea>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div>
                                        <button class="btn btn-primary" type="submit">Submit</button>
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
@endsection 
 
