@extends('layouts.dashboard')
@section('title',"Summary of Salse Commision")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Way Housing Pvt. Ltd</h4> 
                        <p class="m-0">Summary of Salse Commission (For Executive, ASM, AL, ZM, RM, HOS & ED)</p>
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
                            <table class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>Name of Staffs</th>
                                        <th>Des.</th>
                                        <th>Popular City Plaza</th>
                                        <th>AH City Plaza Laxmipur</th>
                                        <th>Shopno Nir 01</th>
                                        <th>Hadid Tower 01</th>
                                        <th>Zam Zam City Plaza</th>
                                        <th>Grand H. Sonapur Plaza</th>
                                        <th>Noahkali Tower</th>
                                        <th>M.N Tower</th> 
                                        <th>A Rob Heights</th>
                                        <th>Ratonpur Square</th>
                                        <th>Wahidul Islam Plaza</th>
                                        <th>Total Achived Comission</th>
                                        <th>Applicable Commission </th>
                                        <th>GTBI RC Deduction</th>
                                        <th>GTBIRC Deducation</th>
                                        <th>Instant Paid Commision</th>
                                        <th>Payble Commision</th>
                                        <th>Achivement</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr class=""> 
                                        <td style="white-space: nowrap;">Mr. Mahbubur Rahman[E-07]</td>
                                        <td>ED</td>
                                        <td>৳217</td>
                                        <td>৳532</td>
                                        <td>৳434</td>
                                        <td>৳217</td>
                                        <td>৳976</td>
                                        <td>৳433</td>
                                        <td>৳434</td>
                                        <td>৳7565</td> 
                                        <td>৳987</td>
                                        <td>৳655</td>
                                        <td>৳7565</td>
                                        <td>৳65554</td>
                                        <td>৳34655</td>
                                        <td>10%</td>
                                        <td>৳655</td>
                                        <td>-</td>
                                        <td>৳655</td>
                                        <td>90%</td>
                                        <td>-</td>
                                        
                                    </tr> 
                                    <tr class=""> 
                                        <td style="white-space: nowrap;">Mr. Mahbubur Rahman[E-07]</td>
                                        <td>ED</td>
                                        <td>৳217</td>
                                        <td>৳532</td>
                                        <td>৳434</td>
                                        <td>৳217</td>
                                        <td>৳976</td>
                                        <td>৳433</td>
                                        <td>৳434</td>
                                        <td>৳7565</td> 
                                        <td>৳987</td>
                                        <td>৳655</td>
                                        <td>৳7565</td>
                                        <td>৳65554</td>
                                        <td>৳34655</td>
                                        <td>10%</td>
                                        <td>৳655</td>
                                        <td>-</td>
                                        <td>৳655</td>
                                        <td>90%</td>
                                        <td>-</td>
                                        
                                    </tr> 
                                    <tr class=""> 
                                        <td style="white-space: nowrap;">Mr. Mahbubur Rahman[E-07]</td>
                                        <td>ED</td>
                                        <td>৳217</td>
                                        <td>৳532</td>
                                        <td>৳434</td>
                                        <td>৳217</td>
                                        <td>৳976</td>
                                        <td>৳433</td>
                                        <td>৳434</td>
                                        <td>৳7565</td> 
                                        <td>৳987</td>
                                        <td>৳655</td>
                                        <td>৳7565</td>
                                        <td>৳65554</td>
                                        <td>৳34655</td>
                                        <td>10%</td>
                                        <td>৳655</td>
                                        <td>-</td>
                                        <td>৳655</td>
                                        <td>90%</td>
                                        <td>-</td>
                                        
                                    </tr> 
                                    <tr class=""> 
                                        <td style="white-space: nowrap;">Mr. Mahbubur Rahman[E-07]</td>
                                        <td>ED</td>
                                        <td>৳217</td>
                                        <td>৳532</td>
                                        <td>৳434</td>
                                        <td>৳217</td>
                                        <td>৳976</td>
                                        <td>৳433</td>
                                        <td>৳434</td>
                                        <td>৳7565</td> 
                                        <td>৳987</td>
                                        <td>৳655</td>
                                        <td>৳7565</td>
                                        <td>৳65554</td>
                                        <td>৳34655</td>
                                        <td>10%</td>
                                        <td>৳655</td>
                                        <td>-</td>
                                        <td>৳655</td>
                                        <td>90%</td>
                                        <td>-</td>
                                        
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