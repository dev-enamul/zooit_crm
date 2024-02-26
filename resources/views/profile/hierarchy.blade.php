@extends('layouts.dashboard')
@section('title',"Profile")

@section('style') 
        <link rel="stylesheet" href="{{asset('assets/libs/jstree/themes/default/style.min.css')}}" />
@endsection 

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.freelancer_menu')
                </div> 
                <div class="col-md-9"> 
                    @include('includes.freelancer_profile_data')
                    {{-- <div class="card overflow-hidden"> 
                        <div class="card-body border-top">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="card-title">About</h4>
                                <div>
                                    <div class="btn btn-secondary cursor-pointer" title="Change Password"  data-bs-toggle="modal" data-bs-target="#change_password_modal">
                                        <i class="mdi mdi-key-change"></i> Change password 
                                    </div>  
                                    <a href="{{route('freelancer.create')}}" class="btn btn-primary cursor-pointer"> 
                                        <i class="mdi mdi-account-edit"></i> Edit Profile
                                    </a>  
                                </div>
                               
                            </div> 
                            <p class="text-muted mb-4">Hi I'm Charlie Stone,has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-account align-middle text-primary me-2"></i> Full Name :</th>
                                            <td>Charlie Stone</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-cellphone align-middle text-primary me-2"></i> Mobile :</th>
                                            <td>(123) 123 1234</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-email text-primary me-2"></i> E-mail :</th>
                                            <td>cynthiaskote@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-google-maps text-primary me-2"></i> Location :</th>
                                            <td>California, United States</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                    </div>  --}}
        
                    {{-- <div class="row border-top">
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-body">
                                    <h4>Deposit Target Achive</h4>
                                    <div id="abc"
                                        data-colors='["--bs-primary", "--bs-success"]'
                                        class="apex-charts"
                                        data-series='[{"name": "Target", "data": [{{$deposit_achive['this_month']}}, {{$deposit_achive['last_month']}}, {{$deposit_achive['last_2_month']}}, {{$deposit_achive['last_6_month']}} , {{$deposit_achive['last_12_month']}}, {{$deposit_achive['last_24_month']}}]}]'
                                        data-xaxis-categories='["This Month", "Last Month", "Last Two Month", "Last Six Month" , "Last One Year", "Last Two Year"]'
                                        data-height="300">
                                    </div>
                                </div> 
                            </div>
                        </div>  
                    </div>   --}}  


                    <div class="card">
                        <div class="card-header">
                            My Employee
                        </div>
                        <div class="card-body">
                            <div id="jstree-1"> 
                                <ul>
                                    <li  data-jstree='{ "opened" : true }'>
                                        {{Auth::user()->name}}
                                        @include('includes.down_employee')
                                    </li>
                                    
                                </ul> 
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
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
    <script src="{{asset('assets/libs/jstree/jstree.min.js')}}"></script>  
    <script src="{{asset('assets/js/pages/treeview.init.js')}}"></script>

    <script>  
        barChart("abc");
        barChart("aaa");
    </script>
@endsection