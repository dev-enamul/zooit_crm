@extends('layouts.dashboard')
@section('title',"Summary of Sales Commision")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Way Housing Pvt. Ltd</h4> 
                        <p class="m-0">Hierarchy Wise Money Receipt (Summary)</p>
                        <p><strong>Period: </strong>1st, December-2023 to 30th, December-2023</p>
                    </div>
                </div>
            </div>  

            <a href="https://www.youtube.com/c/EkattorTelevision?sub_confirmation=1" target="_blank">
                <button>Subscribe to My Channel</button>
            </a>

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

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Name : MD Enamul Haque</th> 
                                        <th>EMP-254</th>
                                        <th>Region: </th>
                                        <th>Zone: Noakhali</th>
                                        <th>Reporting Name & ID : MR Kamruzzaman & 153</th>
                                    </tr>
                                </thead> 
                            </table>

                            <table class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>SN</th>
                                        <th>CUS ID</th>
                                        <th>Customer Name</th>
                                        <th>Booking Date</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Project</th> 
                                        <th>Sales Value</th>
                                        <th>Deposit Amount</th> 
                                        <th>Resale/Adjustment Amount</th>
                                        <th>Cash Amount</th>
                                        <th>Commission Rate (%)</th>
                                        <th>Commission</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr class="">
                                        <td>1</td>
                                        <td>CUS001</td>
                                        <td><a href="#">John Doe</a></td>
                                        <td>2024-01-01</td>
                                        <td>101</td>
                                        <td>2</td>
                                        <td>Project A</td>
                                        <td>৳500,000</td>
                                        <td>৳50,000</td>
                                        <td>৳10,000</td>
                                        <td>৳40,000</td>
                                        <td>8%</td>
                                        <td>৳3,200</td>
                                    </tr>
                                    
                                    <tr class="">
                                        <td>2</td>
                                        <td>CUS002</td>
                                        <td><a href="#">Jane Smith</a></td>
                                        <td>2024-01-02</td>
                                        <td>102</td>
                                        <td>1</td>
                                        <td>Project B</td>
                                        <td>৳300,000</td>
                                        <td>৳30,000</td>
                                        <td>৳5,000</td>
                                        <td>৳25,000</td>
                                        <td>7%</td>
                                        <td>৳1,750</td>
                                    </tr>
                                    
                                    <tr class="">
                                        <td>3</td>
                                        <td>CUS003</td>
                                        <td><a href="#">Alice Johnson</a></td>
                                        <td>2024-01-03</td>
                                        <td>103</td>
                                        <td>3</td>
                                        <td>Project C</td>
                                        <td>৳700,000</td>
                                        <td>৳70,000</td>
                                        <td>৳15,000</td>
                                        <td>৳55,000</td>
                                        <td>9%</td>
                                        <td>৳4,950</td>
                                    </tr> 
                                    <tr class="">
                                        <td>10</td>
                                        <td>CUS010</td>
                                        <td><a href="#">Michael Brown</a></td>
                                        <td>2024-01-10</td>
                                        <td>110</td>
                                        <td>2</td>
                                        <td>Project A</td>
                                        <td>৳400,000</td>
                                        <td>৳40,000</td>
                                        <td>৳8,000</td>
                                        <td>৳32,000</td>
                                        <td>8%</td>
                                        <td>৳2,560</td>
                                    </tr> 

                                    <tr class="">
                                        <td colspan="5" class="text-center"><strong>Total</strong></td>
                                        <td><strong>3</strong></td>
                                        <td></td>
                                        <td><strong>৳2,500,000</strong></td>
                                        <td><strong>৳250,000</strong></td>
                                        <td><strong>৳53,000</strong></td>
                                        <td><strong>৳197,000</strong></td>
                                        <td></td>
                                        <td><strong>৳16,460</strong></td>
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
  
            <div class="col-md-12">
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