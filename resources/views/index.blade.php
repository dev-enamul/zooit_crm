@extends('layouts.dashboard')
@section('title','Dashboard')
@section('content')  
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fs-16 fw-semibold mb-1 mb-md-2">{{$greeting}}, <span class="text-primary">{{auth()->user()->name}}!</span></h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name', 'ZOOM IT') }}</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> 
             <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <h5>Upcoming Activities</h5>
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>Customer Name</th>
                                        <th>Task</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Location</th>
                                        <th>Phone Number</th>
                                        <th>purchase_possibility</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $row)
                                    <tr>
                                        <td>
                                            <a class="text-primary" href="{{ route('customer.profile', encrypt($row['customer_id'])) }}">
                                                {{ $row['customer_name'] }}
                                            </a>
                                        </td> 
                                        <td>{{ $row['type'] }}</td>
                                        <td>{{ $row['date'] }}</td>
                                        <td>{{ $row['time'] }}</td>
                                        <td>{{ $row['location'] }}</td>
                                        <td>
                                            @if($row['phone_number'])
                                                {{ $row['phone_number'] }}
                                                <a href="tel:{{ $row['phone_number'] }}" class="btn btn-primary btn-sm ms-2" style="margin-right: 5px;">
                                                    <i class="fas fa-phone"></i>
                                                </a>

                                                <button class="btn btn-secondary btn-sm copy-phone" data-phone="{{ $row['phone_number'] }}" style="margin-right: 5px;">
                                                    <i class="fas fa-copy"></i>
                                                </button>

                                                <a target="_blank" href="https://api.whatsapp.com/send/?phone={{ preg_replace('/[^0-9]/', '', $row['phone_number']) }}" class="btn btn-success btn-sm" style="margin-right: 5px;">
                                                    <i class="fab fa-whatsapp"></i>
                                                </a>
                                            @endif
                                        </td>

                                        <td>{{ $row['purchase_possibility'] }}</td>
                                        <td>
                                            @if ($row['type'] == 'Followup')
                                                <a class="btn btn-primary" href="{{route('followup.create',['customer' => $row['customer_id']])}}">FollowUp Now</a>
                                            @elseif ($row['type'] == 'Meeting')
                                                <a class="btn btn-primary" href="#"  onclick="approveItem('{{ route('meeting.complete',$row['meeting_id']) }}')">Complete</a>  
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
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
     <script>
        barChart("today_target"); 
        barChart("this_month_target");
    </script> 

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.copy-phone').forEach(function(btn){
                btn.addEventListener('click', function() {
                    const phone = this.getAttribute('data-phone');
                    navigator.clipboard.writeText(phone).then(() => {
                        alert('Phone number copied: ' + phone);
                    });
                });
            });
        });
    </script> 
@endsection