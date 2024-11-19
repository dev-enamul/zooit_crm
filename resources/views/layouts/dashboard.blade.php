<!doctype html>
<html lang="en"> 
<head> 
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name', 'ZOOM IT') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    {{-- @vite(['resources/css/app.css' , 'resources/js/app.js']) --}}
    {{-- Select 2 --}}
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" /> 

    <link href="{{asset('assets/libs/daterangepicker/daterangepicker.css')}}" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
 
    @yield('style') 

</head>


<body>    
    @include('includes.preloader')
    <div id="layout-wrapper">  
        @include('includes.header') 
        @include('includes.sidebar') 
        @yield('content') 
    </div>  

    <div class="modal fade" id="send_whatsapp_message">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Message</h5>
                    <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="whatsappForm">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="col-md-12">
                                <label class="mb-1" for="message">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" rows="3" name="message" placeholder="message"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button class="btn btn-primary" type="button" id="sendWhatsApp">
                                    <i class="fas fa-save"></i> Send
                                </button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
  
    <!-- JAVASCRIPT --> 
    <script>
        var csrfToken = '{{ csrf_token() }}';
    </script>
    
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 
    

    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
 
  
    {{-- Form Validation  --}}
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>

    {{-- Select 2 --}}
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-select2.init.js')}}"></script>

    {{-- Date Picker --}}
    <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script> 
    <script src="{{asset('assets/js/pages/form-datepicker.init.js')}}"></script>

    {{-- Date Range  --}}
    <script src="{{asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/libs/daterangepicker/daterangepicker.js')}}"></script>  
    <script src="{{asset('assets/js/pages/form-rangepicker.init.js')}}"></script>

    {{-- chart  --}} 
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>   
    <script src="{{asset('assets/js/pages/apexcharts-column.init.js')}}"></script>
 
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script> 
    <script src="{{asset('assets/js/alert.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script> 
    @yield('script')
    @yield('script2') 
    <script>
        @if(session('success')) 
            Toast.fire({ icon: "success", title: '{{ session('success') }}' }); 
        @endif  

        @if(session('error'))
            Toast.fire({ icon: "error", title: '{{ session('error') }}' }); 
        @endif 

        @if(session('failed'))
            Toast.fire({ icon: "error", title: '{{ session('failed') }}' }); 
        @endif 

        @if(session('info'))
            Toast.fire({ icon: "info", title: '{{ session('info') }}' }); 
        @endif

        @if(session('warning'))
            Toast.fire({ icon: "warning", title: '{{ session('warning') }}' }); 
        @endif    
        // for remove double click  

        $(document).ready(function(){ 
            $('form').submit(function(event) {  
                var button = $(this).find('button');
                button.prop('disabled', true);  
                setTimeout(function() {
                    button.prop('disabled', false);
                }, 20000);   
            });
    });  

    function sendWhatsapp(id) {
        $('#user_id').val(id);  
        $('#send_whatsapp_message').modal('show');
        }

    $(document).ready(function () {
        $('#sendWhatsApp').on('click', function (e) {
            e.preventDefault(); 
            let $button = $(this);
            $button.prop('disabled', true);
            $button.html('<i class="fas fa-spinner fa-spin"></i> Sending...');
 
            let formData = {
                user_id: $('#user_id').val(),
                message: $('#message').val(),
                _token: $('input[name="_token"]').val(),  
            };
 
            $.ajax({
                url: "{{ route('whatsapp.store') }}", 
                type: "POST",
                data: formData,
                success: function (response) { 
                    $('#send_whatsapp_message').modal('hide'); 
                    Toast.fire({ icon: "success", title: 'Message sent successfully!' }); 
                },
                error: function (xhr, status, error) { 
                    let err = JSON.parse(xhr.responseText); 
                    Toast.fire({ icon: "error", title: err.message || "An error occurred." }); 
                     
                }, 

                complete: function () { 
                    $button.prop('disabled', false);
                    $button.html('<i class="fas fa-save"></i> Send');
                    $('#message').val('')
                },
            });
        });
    });




    </script>
</body>
 
</html>