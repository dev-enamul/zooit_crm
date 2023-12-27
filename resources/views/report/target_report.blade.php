@extends('layouts.dashboard')
@section('title',"Target Sheet")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Way Housing Pvt. Ltd</h4> 
                        <p class="m-0"><b>Target Sheet</b></p>
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
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
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
                                <table class="table table-bordered text-center align-middle  dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class="align-middle"> 
                                            <th rowspan="2" class="text-center">SL</th>
                                            <th rowspan="2" class="text-center">Project Name & Address</th>
                                            <th rowspan="2" class="text-center">Unit & Amount Details</th>
                                            <th colspan="2" class="text-center">MD Safayet Hossain</th>  
                                            <th colspan="2" class="text-center">Md Enamul Haque</th>  
                                            <th colspan="2" class="text-center">Jahid Hasan</th>  
                                            <th colspan="2" class="text-center">MD Safayet Hossain</th>  
                                            <th colspan="2" class="text-center">Md Enamul Haque</th>  
                                            <th colspan="2" class="text-center">Jahid Hasan</th>  
                                            <th colspan="2" class="text-center">Total</th> 
                                        </tr>
                                        <tr class="">  
                                            <th>Unit</th>
                                            <th>Deposit</th>  
                                            <th>Unit</th>
                                            <th>Deposit</th> 
                                            <th>Unit</th>
                                            <th>Deposit</th> 
                                            <th>Unit</th>
                                            <th>Deposit</th>  
                                            <th>Unit</th>
                                            <th>Deposit</th> 
                                            <th>Unit</th>
                                            <th>Deposit</th> 
                                            <th>Unit</th>
                                            <th>Deposit</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr class=""> 
                                            <td rowspan="2" class="text-center">1</td>
                                            <td rowspan="2" class="text-center">HADID Tower 02, Dhaka</td>
                                            <td>New</td> 
                                            <td>1</td> 
                                            <td>43442</td>  
                                            <td>1</td> 
                                            <td>456456</td>  
                                            <td>1</td> 
                                            <td>466</td>  
                                            <td>1</td> 
                                            <td>8978</td>  
                                            <td>1</td> 
                                            <td>35345</td>  
                                            <td>1</td> 
                                            <td>23423</td> 
                                            <td>1</td> 
                                            <td>897</td> 
                                        </tr>  
                                        <tr class="">  
                                            <td>Existing</td> 
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td> 
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>   
                                        </tr> 

                                        {{-- Project wise total   --}}
                                        <tr class="" style="font-weight: bold">  
                                            <td colspan="3" class="text-end">Total</td> 
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td> 
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>  
                                            <td>3</td> 
                                            <td>4</td>   
                                        </tr> 
                                    </tbody>
                                </table> 
                                <div class="d-">
                                    <div class="p-2">
                                        Ramgonj Team
                                    </div>
                                    <div class="p-2">
                                        17000000 
                                    </div>
                                </div>
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

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="project" class="form-label">Project</label>
                    <select class="select2" multiple name="project" id="project"> 
                        <option value="">Popular City Plaza</option>
                        <option value="">AH City Plaza</option>
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