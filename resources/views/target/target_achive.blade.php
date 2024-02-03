@extends('layouts.dashboard')
@section('title','Target Achivement')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Target Achivement</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Target Achivement    </li>
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
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button> 
                                    </div> 
                                    <div class="dt-buttons btn-group flex-wrap mb-2">     
                                        <button class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#modal6"> <i class="mdi mdi-chart-box-outline"></i> View Chart</button> 
                                    </div>
                                </div>
                                <div class="">  
                                    <div class="input-group">  
                                        <input class="form-control" type="text" id="daterangepicker" />   
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>S/N</th>
                                        <th>Date</th> 
                                        <th>Customer Entry</th>
                                        <th>Freelancer Entry</th>
                                        <th>Prospecting</th> 
                                        <th>Cold Calling</th>
                                        <th>Lead</th>
                                        <th>Progress</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr> 
                                        <td>1</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 40%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr class="success_row"> 
                                        <td>2</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr> 
                                        <td>3</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr> 
                                        <td>4</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr class="row_info"> 
                                        <td>4</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr class="row_secondary"> 
                                        <td>6</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    <tr class="row_primary"> 
                                        <td>7</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                     <tr class="row_danger"> 
                                        <td>8</td>
                                        <td>30/10/2023</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>
                                                    <span>12/6</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>55%</h6>
                                                    <span>12/8</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 55%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>60%</h6>
                                                    <span>13/9</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>100%</h6>
                                                    <span>20/20</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>10%</h6>
                                                    <span>100/10</span> 
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </td> 

                                        <td class="align-middle">
                                            <div class="">
                                                <h6>60%</h6>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                </div>
                                            </div>
                                        </td> 
                                        <td>Average</td>
                                    </tr>

                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

     @include('includes.footer')

</div> 

<div class="modal fade" id="modal6">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Achivement <span class="text-info">[1 May-2023 - 30 May, 2023]</span></h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>
            <div class="modal-body">
                <div id="abc"
                    data-colors='["--bs-primary", "--bs-success"]'
                    class="apex-charts"
                    data-series='[{"name": "Target", "data": [90, 60, 70, 80, 90]},{"name": "Achivement", "data": [80, 60, 50, 40, 10]}]'
                    data-xaxis-categories='["Freelancer Join", "Customer Join", "Prospecting", "Cold Calling", "Lead"]'
                    data-height="400">
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection 

@section('script')
<script>
    barChart("abc"); 
    getDateRange('daterangepicker');
</script>
@endsection