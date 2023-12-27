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
    document.addEventListener('DOMContentLoaded', function() {
       var calendarEl = document.getElementById('calendar');
   
       var calendar = new FullCalendar.Calendar(calendarEl, {
         headerToolbar: {
           left: 'prev,next today',
           center: 'title',
           right: 'dayGridYear,dayGridMonth,timeGridWeek'
         },
         initialView: 'dayGridMonth',
         initialDate: '2023-12-12',
         editable: true,
         selectable: true,
         dayMaxEvents: true, 
         events: [
           {
             title: 'Language Training',
             start: '2023-12-12'
           },
           {
             title: 'Long Event',
             start: '2023-01-07',
             end: '2023-01-10'
           },
           {
             groupId: 999,
             title: 'Repeating Event',
             start: '2023-01-09T16:00:00'
           },
           {
             groupId: 999,
             title: 'Repeating Event',
             start: '2023-01-16T16:00:00'
           },
           {
             title: 'Conference',
             start: '2023-01-11',
             end: '2023-01-13'
           },
           {
             title: 'Meeting',
             start: '2023-01-12T10:30:00',
             end: '2023-01-12T12:30:00'
           },
           {
             title: 'Lunch',
             start: '2023-01-12T12:00:00'
           },
           {
             title: 'Meeting',
             start: '2023-01-12T14:30:00'
           },
           {
             title: 'Happy Hour',
             start: '2023-01-12T17:30:00'
           },
           {
             title: 'Dinner',
             start: '2023-01-12T20:00:00'
           },
           {
             title: 'Birthday Party',
             start: '2023-01-13T07:00:00'
           },
           {
             title: 'Click for Google',
             url: 'http://google.com/',
             start: '2023-12-28'
           }
         ]
       });
   
       calendar.render();
     });
    
   </script>
@endsection