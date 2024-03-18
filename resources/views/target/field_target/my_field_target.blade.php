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
                                    <form action="" method="get" action="">
                                        <div class="input-group">  
                                            <input class="form-control" type="month" name="month" value="{{$selected != ''?$selected:now()->format('Y-m') }}"/>   
                                            <button class="btn btn-secondary" type="submit">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </form> 
                                </div>
                           </div>

                           <div class="table-box" style="overflow-x: scroll;">
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>S/N</th>
                                        <th>Tile</th>  
                                        <th class="text-center">Target</th>
                                        <th class="text-center">Achivement</th>
                                        <th class="text-center">Progress</th> 
                                    </tr>
                                </thead>
                                @if($data)
                                <tbody>  
                                        <tr> 
                                            <td>1</td>
                                            <td>FL Recruitment</td>  
                                            <td class="align-middle text-center">{{$data->freelancer}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>2</td>
                                            <td>Customer Data</td>  
                                            <td class="align-middle text-center">{{$data->customer}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>3</td>
                                            <td>Prospecting</td>  
                                            <td class="align-middle text-center">{{$data->prospecting}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>4</td>
                                            <td>Cold calling</td>  
                                            <td class="align-middle text-center">{{$data->cold_calling}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>5</td>
                                            <td>Lead</td>  
                                            <td class="align-middle text-center">{{$data->lead}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>6</td>
                                            <td>Lead Analysis</td>  
                                            <td class="align-middle text-center">{{$data->lead_analysis}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>7</td>
                                            <td>Project Visit</td>  
                                            <td class="align-middle text-center">{{$data->project_visit}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>8</td>
                                            <td>Project Visit Analysis</td>  
                                            <td class="align-middle text-center">{{$data->project_visit_analysis}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>9</td>
                                            <td>Follow Up</td>  
                                            <td class="align-middle text-center">{{$data->follow_up}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>10</td>
                                            <td>Follow Up Analysis</td>  
                                            <td class="align-middle text-center">{{$data->follow_up_analysis}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>11</td>
                                            <td>Negotiation</td>  
                                            <td class="align-middle text-center">{{$data->negotiation}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr>

                                        <tr> 
                                            <td>12</td>
                                            <td>Negotiation Analysis</td>  
                                            <td class="align-middle text-center">{{$data->negotiation_analysis}}</td>
                                            <td class="align-middle text-center">0</td> 
                                            <td class="align-middle text-center">0%</td> 
                                        </tr> 
                                </tbody>
                                @else  
                                <tbody>  
                                    <tr> 
                                        <td colspan="5" class="text-center">You currently do not have any field targets set up</td>
                                    </tr>
                                @endif
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
  
@endsection 

@section('script')
<script>
    barChart("abc"); 
    getDateRange('daterangepicker');
</script>
@endsection