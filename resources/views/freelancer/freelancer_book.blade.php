@extends('layouts.dashboard')
@section('title',"Profile");
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           @include('includes.freelancer_profile_data')

            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.freelancer_menu')
                </div> 
                <div class="col-md-9"> 
                    <div class="card overflow-hidden"> 
                        <div class="card-body">
                            <h4 class="card-title">Book Reading</h4>
                            <hr>
                            <div class="timeline timeline-zigzag">
                                 
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-circle text-danger"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">
                                            </p><p class="m-0 bold-lg">Epic Content Marketing by Joe Pullizzi</p>
                                            <p class="m-0 fs-10">30 Dec, 2023</p>
                                            Epic Content Marketing" by Joe Pulizzi offers a strategic guide on creating compelling content that not only engages audiences but also serves as a valuable asset in building and sustaining successful marketing campaigns.
                                        <p></p>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-circle text-info"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">
                                            </p><p class="m-0 bold-lg">Buy.logy by Martin Lindstrom"</p>
                                            <p class="m-0 fs-10">30 Dec, 2023</p>
                                            Buyology" by Martin Lindstrom provides a captivating exploration of the subconscious influences on consumer behavior through neuroscience and psychology, offering intriguing insights into the world of marketing and branding.
                                        <p></p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-circle text-danger"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">
                                            </p><p class="m-0 bold-lg">Epic Content Marketing by Joe Pullizzi</p>
                                            <p class="m-0 fs-10">30 Dec, 2023</p>
                                            Epic Content Marketing" by Joe Pulizzi offers a strategic guide on creating compelling content that not only engages audiences but also serves as a valuable asset in building and sustaining successful marketing campaigns.
                                        <p></p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-circle text-info"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0">
                                            </p><p class="m-0 bold-lg">Buy.logy by Martin Lindstrom"</p>
                                            <p class="m-0 fs-10">30 Dec, 2023</p>
                                            Buyology" by Martin Lindstrom provides a captivating exploration of the subconscious influences on consumer behavior through neuroscience and psychology, offering intriguing insights into the world of marketing and branding.
                                        <p></p>
                                    </div>
                                </div>
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
 