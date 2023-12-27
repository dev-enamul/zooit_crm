@extends('layouts.dashboard')
@section('title','Training History')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Training History</h4>

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
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
                                        </button> 
                                    </div>  
                                </div>

                                <div class="">  
                                    <div class="input-group">  
                                        <input class="form-control" id="filter_input" type="text" />   
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th class="text-center">Action</th> 
                                        <th class="text-center">S/L</th>
                                        <th class="text-center">Date Time</th>
                                        <th>Title</th>  
                                        <th>Trainer</th> 
                                        <th>Attendance</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr> 
                                        <td class="text-center align-middle"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center align-middle">1</td> 
                                        <td class="text-center align-middle">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td class="align-middle">Language training</td> 
                                        <td class="align-middle">
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="align-middle"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="">
                                                        +4
                                                    </a> 
                                                </div>
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">12 Nov, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Digital Marketing Strategies </td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div> 
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Content Marketing Mastery</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="">
                                                        +3
                                                    </a> 
                                                </div>
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Data-Driven</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                              
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Branding and Positioning</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="">
                                                        +3
                                                    </a> 
                                                </div>
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Lead Generation Tactics</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="">
                                                        +3
                                                    </a> 
                                                </div>
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Effective Communication</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                               
                                            </div>
                                         </td>
                                    </tr>

                                    <tr> 
                                        <td class="text-center"><a href="{{route('training.details')}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> View</a></td>
                                        <td class="text-center">1</td> 
                                        <td class="text-center">06 Dec, 2023 <br> <span class="badge badge-label-primary">4:40PM - 5:20PM</span></td>
                                        <td>Personal Branding</td> 
                                        <td>
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs">
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                </div> 
                                            </div>
                                        </td> 
                                        <td class="fs-12"> 
                                            <div class="avatar-group">
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Md Enamul Haque">
                                                        <img src="../assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs cursor-pointer">
                                                    </a>
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-2.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-3.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-4.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>
                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="" data-bs-toggle="tooltip" title="Jamilur Rahman">
                                                        <img src="../assets/images/users/avatar-5.png" alt="Avatar image" class="avatar-2xs">
                                                    </a> 
                                                </div>

                                                <div class="avatar avatar-circle avatar-circle-sm">
                                                    <a href="">
                                                        +3
                                                    </a> 
                                                </div>
                                            </div>
                                         </td>
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
@endsection