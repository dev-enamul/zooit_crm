@extends('layouts.dashboard')
@section('title',"Invoice List")
 @section('style')
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    
 @endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
 
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"> Project List</h4> 
                            <div class="page-title-right">
                                <div class="btn-group flex-wrap mb-2">
                                    <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button>
                                </div>
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
                                    {{ $dataTable->table(['class' => 'table table-hover table-bordered table-striped dt-responsive nowrap fs-10']) }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div> 

    <div class="offcanvas offcanvas-end" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Select Filter Item</h5>
            <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row"> 

                {{-- <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Date</label>
                        <input class="form-control" start="{{$start_date}}" end="{{$end_date}}" id="date_range" name="date" default="This Month" type="text" value="" />
                    </div>
                </div> --}}

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="project" class="form-label">Employee</label>
                        <select class="select2" search id="project" name="project_id">
                            <option value = "" selected="selected">All Employee</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div>
            </div>
        </form>
        </div>
    </div> 
 

@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script> 
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script>
    $(document).ready(function() {  
            $('#project').select2({
                placeholder: "Select Project",
                allowClear: true,
                dropdownParent: $('#offcanvas'),
                ajax: {
                    url: '{{ route('select2.project') }}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            term: params.term
                        }
                        return query;
                    }
                }
            });
        });

    getDateRange('date_range');
</script>

<script>
    function shareLink(id,phone){
        var link = "{{ route('invoice.share', ':id') }}".replace(':id', id); 
        $('#invoice-link').val(link);
        $('#prevButton').attr('href',link);
        var whatsappLink = "https://api.whatsapp.com/send/?phone=+88"+phone+"&text="+link;
        $("#whatsAppButton").attr('href',whatsappLink);
        $('#edit_modal').modal('show');
    }
    $(document).ready(function() { 
        $('#copyLinkButton').click(function() {
            var copyText = $('#invoice-link');
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);  
            document.execCommand('copy'); 
            Toast.fire({ icon: "success", title: 'Invoice link copied to clipboard!' });  
        });

        
    });
</script>
@endsection
