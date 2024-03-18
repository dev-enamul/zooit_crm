@extends('layouts.dashboard') 
@section('title','Task Complete')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Task Complete History </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Task History</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div> 
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
                                        <th>Action</th> 
                                        <th>S/N</th> 
                                        <th>Date</th> 
                                        <th>Assign Task</th>
                                        <th>Complete Task</th>
                                        <th>Progress</th>  
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $data)
                                    <tr> 
                                        <td class="text-center"><button data-bs-toggle="modal" data-bs-target="#view_detail" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i> View</button></td>
                                        <td>1</td>
                                        <td>30 September,2023</td>
                                        <td>10</td>
                                        <td>5</td>
                                        <td class="align-middle">
                                            <div class="">
                                                <div class="d-flex justify-content-between">
                                                    <h6>50%</h6>  
                                                </div>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                </div>
                                            </div>
                                        </td>  
                                        <td>Average</td>
                                    </tr> 
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div>

  @include('includes.footer') 
</div> 

<div class="modal fade" id="view_detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card"> 
                <div class="card-body">
                    <h3 class="card-title">Task Details <span class='text-primary'>[1 Decemer,2023]</span></h3>
                    <div class="timeline timeline-timed"> 
                        <div class="timeline-item">
                            <span class="timeline-time">14:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-check fs-16 text-primary"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Received a new feedback on <a href="#">GoFinance</a> App product.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-time">15:20</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-times fs-16 text-danger"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <span class="timeline-time">17:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-times fs-16 text-danger"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-time">17:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-times fs-16 text-danger"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-time">17:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-check fs-16 text-primary"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-time">17:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-check fs-16 text-primary"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <span class="timeline-time">17:00</span>
                            <div class="timeline-pin"><i class="fas fa-calendar-check fs-16 text-primary"></i></div>
                            <div class="timeline-content">
                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection 

@section('script')
    <script>
        getDateRange('daterangepicker')
    </script>
@endsection