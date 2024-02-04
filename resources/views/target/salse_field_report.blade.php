@extends('layouts.dashboard')
@section('title',"Sales Executive Report")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Salse Executive Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Salse Executive Report</li>
                            </ol>
                        </div>

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
                                        <div class="input-group">  
                                            <select class="select2" search name="profession" id="profession">
                                                <option value="">Select Executive</option>
                                                <option value="1">MD Enamul Haque #6767</option>
                                                <option value="2">John Doe #1234</option>
                                                <option value="3">Jane Smith #5678</option>
                                                <option value="4">Ahmed Khan #9876</option>
                                                <option value="5">Maria Rodriguez #3456</option>
                                                <option value="6">Alex Johnson #7890</option>
                                                <option value="7">Emily White #2345</option>
                                                <option value="8">David Brown #6543</option>
                                                <option value="9">Sara Miller #2109</option>
                                                <option value="10">Chris Taylor #8765</option> 
                                            </select> 
                                            <button class="btn btn-secondary" type="submit">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="text-center">
                            <h5 class="m-0">{{ config('app.name', 'ZOOM IT') }}</h5>
                            <p class="mb-1" ><b>Designation Wise Marketing & Sales Work - Target vs Achievement  </b> </p>
                           </div>
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
                           
                            <div class="table-box" style="overflow-x: scroll;">
                                <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class=""> 
                                            <th rowspan="2" class="align-middle">S/N</th>
                                            <th rowspan="2" class="align-middle">Freelancer Name & ID</th>
                                            <th colspan="3">FL Recruitment</th>
                                            <th colspan="3">Customer Data Collection</th>
                                            <th colspan="3">Prospecting</th>
                                            <th colspan="3">Cold calling</th>
                                            <th colspan="3">LEAD</th>
                                            <th colspan="3">Presentation</th> 
                                            <th colspan="3">Follow Up</th>
                                            <th colspan="3">Negotiation</th>
                                            <th colspan="3">Rejection</th>
                                            <th colspan="3">Rejection</th>
                                            <th colspan="3">Project Visit</th>
                                            <th colspan="3">Sales Unit</th>
                                            <th colspan="3">Sales Deposite</th>
                                        </tr>
    
                                        <tr class="">  
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                            <th>T</th>
                                            <th>A</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr>
                                            <td>2</td>
                                            <td>Jane Smith #456</td>
                                            <td>8</td>
                                            <td>7</td>
                                            <td>87.5%</td>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>83.33%</td>
                                            <td>18</td>
                                            <td>16</td>
                                            <td>88.89%</td>
                                            <td>22</td>
                                            <td>18</td>
                                            <td>81.82%</td>
                                            <td>28</td>
                                            <td>24</td>
                                            <td>85.71%</td>
                                            <td>33</td>
                                            <td>28</td>
                                            <td>84.85%</td>
                                            <td>8</td>
                                            <td>7</td>
                                            <td>87.5%</td>
                                            <td>12</td>
                                            <td>10</td>
                                            <td>83.33%</td>
                                            <td>18</td>
                                            <td>16</td>
                                            <td>88.89%</td>
                                            <td>22</td>
                                            <td>18</td>
                                            <td>81.82%</td>
                                            <td>28</td>
                                            <td>24</td>
                                            <td>85.71%</td>
                                            <td>33</td>
                                            <td>28</td>
                                            <td>84.85%</td>
                                            <td>33</td>
                                            <td>28</td>
                                            <td>84.85%</td>
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

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
</div> 
 
@endsection 

@section('script')
    <script>
        getDateRange('daterangepicker');
    </script>
@endsection