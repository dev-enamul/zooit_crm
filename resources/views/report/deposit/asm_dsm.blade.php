@extends('layouts.dashboard')
@section('title',"Deposit Report for ASM and DSM")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Way Housing Pvt. Ltd</h4> 
                        <p class="m-0">Project, Unit - Salse Executive & ASM/DSM Wise Deposit Report</p>
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
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>
        
                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button> 
                                    </div> 
                                </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
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
                                        <th>CUS ID</th>
                                        <th>Customer Name</th>
                                        <th>Booking Date</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty</th>
                                        <th>Franchise Partner Name & ID</th>
                                        <th>Co-Ordinator Applicant Name & ID</th>
                                        <th>Co-Ordinator Name & ID</th> 
                                        <th>Ex. Co-Ordinator Name & ID</th>
                                        <th>Sales Executive Name & ID</th>
                                        <th>ASM/DSM Name & ID</th>
                                        <th>Declaration Price</th>
                                        <th>Discount Amount</th>
                                        <th>Sales Value </th>
                                        <th>Deposit Amount</th>
                                        <th>Total Deposit Amount</th>
                                        <th>Total Due Amount</th>
                                        <th>Remarks</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr class=""> 
                                        <td>1</td>
                                        <td>#231</td>
                                        <td>Md Enamul Haque</td>
                                        <td>11, Dec-2023</td>
                                        <td>City Plaza</td>
                                        <td>Shop</td>
                                        <td>5</td>
                                        <td>MD Jahid Hasan (#5333)</td>
                                        <td>MD Mehedi Hasan (#6755)</td>
                                        <td>Md Rahim (#5645)</td> 
                                        <td>MD Jahid Hasan (#5333)</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>5000000</td>
                                        <td>1000000</td>
                                        <td>4000000</td>
                                        <td>10000</td>
                                        <td>3500000</td>
                                        <td>1500000</td>
                                        <td>Remarks</td>  
                                    </tr>  
                                    <tr class=""> 
                                        <td>2</td>
                                        <td>#232</td>
                                        <td>John Doe</td>
                                        <td>12, Dec-2023</td>
                                        <td>Main Street Apartments</td>
                                        <td>Unit B</td>
                                        <td>3</td>
                                        <td>Jane Smith (#1234)</td>
                                        <td>Michael Johnson (#5678)</td>
                                        <td>David Brown (#9876)</td> 
                                        <td>MD Jahid Hasan (#5333)</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>6000000</td>
                                        <td>1200000</td>
                                        <td>4800000</td>
                                        <td>15000</td>
                                        <td>4650000</td>
                                        <td>1500000</td>
                                        <td>Additional Remarks</td>  
                                    </tr>  
                                    <tr class=""> 
                                        <td>3</td>
                                        <td>#233</td>
                                        <td>Jane Smith</td>
                                        <td>13, Dec-2023</td>
                                        <td>Ocean View Residency</td>
                                        <td>Apartment 302</td>
                                        <td>1</td>
                                        <td>Michael Johnson (#5678)</td>
                                        <td>Emily Davis (#3456)</td>
                                        <td>Sophia Wilson (#8765)</td> 
                                        <td>MD Jahid Hasan (#5333)</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>7000000</td>
                                        <td>1400000</td>
                                        <td>5600000</td>
                                        <td>20000</td>
                                        <td>5580000</td>
                                        <td>2000000</td>
                                        <td>More Remarks</td>  
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
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration </label>
                    <input class="form-control" id="duration" name="duration" default="This Month" type="text" value="" />   
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