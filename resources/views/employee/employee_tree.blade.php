@extends('layouts.dashboard') 
@section('title','Employee Tree') 
@section('style') 
        <link rel="stylesheet" href="{{asset('assets/libs/jstree/themes/default/style.min.css')}}" />
        <style>

            @media print {
                @page {
                    size: A4;
                    margin-top: 10mm; 
                }
                .page-break {
                    page-break-before: always;
                }
            }

            .select2-container{
                width: 200px !important;
                
            }
            .select2-selection__rendered{
                background: #fff !important;
            }
        </style>
@endsection 

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <button class="btn btn-secondary buttons-pdf buttons-html5" id="print" type="button"><span><i class="fa fa-print"></i> Print</span></button> 
                        </div>

                        <div class="">   
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <select class="select2" search name="employee" id="employee" required>
                                        <option value="{{auth()->user()->id}}" selected="selected">{{Auth::user()->name}}</option>
                                    </select>
                                    <button class="btn btn-secondary" type="submit">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </form> 
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">  
                    <div class="card">
                       <div class="card-header">
                            <h4 class="card-title text-center">Employee Tree - {{$employee->name}} [{{$employee->user_id}}]</h4>
                       </div>
                        <div class="card-body">
                            <div id="jstree-1"> 
                               @include('includes.down_employee')
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- End Page-content -->

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
          $(document).ready(function() { 
            $('#employee').select2({
                placeholder: "Select Employee",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.employee.freelancer') }}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            term: params.term
                        }
                        return query;
                    }
                }
            });

            $('#print').on('click', function() {
                window.print();
            });
        });
    </script>
@endsection