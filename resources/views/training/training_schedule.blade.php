@extends('layouts.dashboard')
@section('title','Training History')
@section('style')
    <style>
      .fc-event, .fc-event-dot {
          background-color: #ddd !important;
          display: block;
      }
      .fc-daygrid-more-link{
        color: #ddd;
      }
    </style>
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Training Schedule </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Training Schedule</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card"> 
                        <div class="card-body">
                            <div id='calendar'></div>
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
<script src="{{asset('assets/js/pages/index.global.js')}}"></script> 

<script> 
var today = new Date();
 var datas = {!! json_encode($datas) !!};
  

// Get tomorrow's date
var tomorrow = new Date(today);
tomorrow.setDate(today.getDate() + 1);

    document.addEventListener('DOMContentLoaded', function() {
       var calendarEl = document.getElementById('calendar');
   
       var calendar = new FullCalendar.Calendar(calendarEl, {
         headerToolbar: {
           left: 'prev,next today',
           center: 'title',
           right: 'dayGridYear,dayGridMonth,timeGridWeek'
         },
         initialView: 'dayGridMonth',
         initialDate: Date.now(),
         editable: true,
         selectable: true,
         dayMaxEvents: true, 
         events: datas,
       });
   
       calendar.render();
     });
    
     $(document).ready(function() {
       $('.fc-daygrid-more-link').closest('.fc-scrollgrid-sync-inner').css('background', '#1a252f');
     }); 
   </script>
@endsection