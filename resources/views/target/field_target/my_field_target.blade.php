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
                        <p class="d-none">{{$user->name}} [{{$user->user_id}}] 
                            {{get_date($start_date)}} to {{get_date($end_date)}}
                        </p> 
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="12">

                        <div class="page-title-right">
                            <form action="" method="get">
                                <div class="mb-4">
                                    <div class="row">
                                      <div class="col-md-3">
                                          <label for="start_date" class="form-label">Start Date</label>
                                          <input type="number" class="form-control" name="start_date" id="start_date" value="{{get_date($start_date,'d')}}">
                                      </div>
                                      <div class="col-md-3">
                                          <label for="end_date" class="form-label">End Date</label>
                                          <input type="number" class="form-control" name="end_date" id="end_date" value="{{get_date($end_date,'d')}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="month" class="form-label">Month</label>
                                          <div class="input-group">  
                                              <input type="month" id="month" class="form-control" name="month" value="{{ $month }}">
                                              <button class="btn btn-secondary btn-sm" type="submit">
                                                  <span><i class="fas fa-filter"></i> Filter</span>
                                              </button>  
                                          </div>
                                      </div>
                                    </div>
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
                                                <td class="align-middle text-center">{{target_cal($data->freelancer,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['freelancer']}}</td> 
                                                <td class="align-middle text-center">{{$per['freelancer']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>2</td>
                                                <td>Customer Data</td>  
                                                <td class="align-middle text-center">{{target_cal($data->customer,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['customer']}}</td> 
                                                <td class="align-middle text-center">{{$per['customer']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>3</td>
                                                <td>Prospecting</td>  
                                                <td class="align-middle text-center">{{target_cal($data->prospecting,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['prospecting']}}</td> 
                                                <td class="align-middle text-center">{{$per['prospecting']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>4</td>
                                                <td>Cold calling</td>  
                                                <td class="align-middle text-center">{{target_cal($data->cold_calling,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['cold_calling']}}</td> 
                                                <td class="align-middle text-center">{{$per['cold_calling']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>5</td>
                                                <td>Lead</td>  
                                                <td class="align-middle text-center">{{target_cal($data->lead,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['lead']}}</td> 
                                                <td class="align-middle text-center">{{$per['lead']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>6</td>
                                                <td>Lead Analysis</td>  
                                                <td class="align-middle text-center">{{target_cal($data->lead_analysis,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['lead_analysis']}}</td> 
                                                <td class="align-middle text-center">{{$per['lead_analysis']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>7</td>
                                                <td>Project Visit</td>  
                                                <td class="align-middle text-center">{{target_cal($data->project_visit,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{ $achive['presentation']}}</td> 
                                                <td class="align-middle text-center">{{$per['presentation']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>8</td>
                                                <td>Project Visit Analysis</td>  
                                                <td class="align-middle text-center">{{target_cal($data->project_visit_analysis,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['visit_analysis']}}</td> 
                                                <td class="align-middle text-center">{{$per['visit_analysis']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>9</td>
                                                <td>Follow Up</td>  
                                                <td class="align-middle text-center">{{target_cal($data->follow_up,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['followup']}}</td> 
                                                <td class="align-middle text-center">{{$per['followup']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>10</td>
                                                <td>Follow Up Analysis</td>  
                                                <td class="align-middle text-center">{{target_cal($data->follow_up_analysis,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['followup_analysis']}}</td> 
                                                <td class="align-middle text-center">{{$per['followup_analysis']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>11</td>
                                                <td>Negotiation</td>  
                                                <td class="align-middle text-center">{{target_cal($data->negotiation,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['negotiation']}}</td> 
                                                <td class="align-middle text-center">{{$per['negotiation']}}</td> 
                                            </tr>

                                            <tr> 
                                                <td>12</td>
                                                <td>Negotiation Analysis</td>  
                                                <td class="align-middle text-center">{{target_cal($data->negotiation_analysis,$total_days,$diff)}}</td>
                                                <td class="align-middle text-center">{{$achive['negotiation_analysis']}}</td> 
                                                <td class="align-middle text-center">{{$per['negotiation_analysis']}}</td> 
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