@extends('layouts.dashboard')
@section('title',"Daily Total Deposit")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">{{ config('app.name', 'ZOOM IT') }}</h4> 
                        <p class="m-0">Daily Deposit - Marketing Executive</p>
                        <p><strong>Period: </strong>1st, December-2023 to 30th, December-2023</p>
                    </div>
                </div>
            </div>
            <!-- end page title -->

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
                            <div class="d-flex justify-content-between"> 
                                <div class="">
                                    <div class="btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>
        
                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
                                        </button> 
                                    </div> 
                                </div>
                                <div class="">
                                    <div class="btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table class="table table-hover align-middle text-center table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th>SL.</th>
                                        <th>Name of Employee</th>
                                        <th>Total Target</th>
                                        <th>Regolar Deposit</th>
                                        <th>Block Factory Share Deposit</th>
                                        <th>Franchise Partner Security Deposit</th>
                                        <th>Build BD Share Deposit</th>
                                        <th>S.T.I Deposit</th>
                                        <th>Total Collection</th>
                                        <th>T & A %</th> 
                                        <th>Market Share</th>
                                        <th>Remaining Target</th>
                                        <th>Daily Target</th>
                                        <th>Remaining Daily Target</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr class=""> 
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>100,000</td>
                                        <td>20,000</td>
                                        <td>10,000</td>
                                        <td>5,000</td>
                                        <td>8,000</td>
                                        <td>7,000</td>
                                        <td>50,000</td>
                                        <td>80%</td>
                                        <td>15%</td>
                                        <td>50,000</td>
                                        <td>10,000</td>
                                        <td>40,000</td> 
                                    </tr>   
                                </tbody>
                            </table>
                           </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 

    @include('includes.footer')

</div> 

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row">   
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="duration" class="form-label">Month </label>
                    {{-- <input class="form-control" id="duration" name="duration" default="This Month" type="text" value="" />    --}}
                    <input type="month" name="month" class="form-control" id="">
                </div>
            </div>  
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="position" class="form-label">Employee Position </label>
                    <select class="select2" name="position" id="position" > 
                        <option value="1">Salse Executive</option>
                        <option value="2">Area InCharge</option> 
                        <option value="2">Zonal Manager</option> 
                    </select>  
                </div>
            </div>

            <div class="col-md-6"> 
                <div class="mb-3">
                    <label for="division" class="form-label">Division </label>
                    <select class="select2" name="division" id="division" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>
 
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="area" class="form-label">Area </label>
                    <select class="select2" name="area" id="area" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>
 
            <div class="col-md-6"> 
                <div class="mb-3">
                    <label for="zone" class="form-label">Zone </label>
                    <select class="select2" name="zone" id="zone" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="district" class="form-label">District </label>
                    <select class="select2" name="district" id="district" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="upazila" class="form-label">Thana/Upazila </label>
                    <select class="select2" name="upazila" id="upazila">
                        <option value="">All</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="union" class="form-label">Union </label>
                    <select class="select2" name="union" id="union">
                        <option value="">All</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select>  
                </div>
            </div> 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        getDateRange('duration')
    </script>
@endsection