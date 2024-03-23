@extends('layouts.dashboard')
@section('title','Target Vs Achivement')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Target Vs Achivement</h4> 
                        <p class="d-none">{{$user->name}} [{{$user->user_id}}]</p> 
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="12">

                        <div class="page-title-right">
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
                </div>
            </div>
            <!-- end page title -->

         
          
            <div class="row"> 
                <div class="col-12">

                    
                    <div class="card"> 
                        <div class="card-body">
                             
                           <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
@include('includes.data_table')
<script> 
    barChart("abc"); 
    getDateRange('daterangepicker');
</script>
@endsection