@extends('layouts.dashboard')
@section('title',"Monthly Target Vs Achivement")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Zoom IT</h4> 
                        <p class="m-0">Designation, Customer, Project & Deposit Wise All Commission Details</p>
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
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
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
                            <table class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>S/L</th>
                                        <th>Achiever</th>
                                        <th>Designation</th>
                                        <th>Customer</th>
                                        <th>Project</th>
                                        <th>Unit</th> 
                                        <th>Unit</th>
                                        <th>Sold</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Total Due</th>
                                        <th>Achieved Regular</th>
                                        <th>Applicable Regular</th>
                                        <th>Achieved Special</th>
                                        <th>Applicable Special</th>
                                        <th>Total Deducted</th>
                                        <th>Payable Date</th>
                                        <th>Payable Amount</th>
                                        <th>Instant Paid</th>
                                        <th>Total Due</th>
                                        <th>Total Due</th>
                                        <th>Reporting Person</th>
                                        <th>Area</th>
                                        <th>Remark</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                
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
        <h5 class="offcanvas-title">Filter Report</h5>
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
  
            {{-- <div class="col-md-12">
                <div class="mb-3">
                    <label for="profession" class="form-label">Position</label>
                    <select class="select2" multiple name="profession" id="profession"> 
                        <option value="">Freelancer</option>
                        <option value="">Co Ordinator</option> 
                        <option value="">Ordinator</option>
                        <option value="">Salse Executive</option>
                        <option value="">Marketing Executive</option>
                    </select>  
                </div>
            </div>   --}}

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