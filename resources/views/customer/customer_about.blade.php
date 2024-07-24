@extends('layouts.dashboard')
@section('title',"Profile")
@section('content')
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('customer.includes.customer_sidebar')
                </div> 
                <div class="col-md-9">   
                    @include('customer.includes.customer_menu')
                    <div class="col-xl-12">
                        <div class="card"> 
                            <div class="card-body"> 
                                <div class="accordion" id="accordionExample-general">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-general" aria-expanded="true" aria-controls="collapseOne-general">
                                                <i class="mdi mdi-check-all me-2 align-middle"></i>Primary Information
                                            </button>
                                        </h2>
                                        <div id="collapseOne-general" class="accordion-collapse collapse show" data-bs-parent="#accordionExample-general">
                                            <div class="accordion-body">
                                                <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing.</p>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#location" aria-expanded="true" aria-controls="location">
                                                <i class="mdi mdi-check-all me-2 align-middle"></i>Location
                                            </button>
                                        </h2>
                                        <div id="location" class="accordion-collapse collapse" data-bs-parent="#accordionExample-general">
                                            <div class="accordion-body">
                                                <p class="text-muted mb-0">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing.</p>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div> 
        </div> 
    </div>  
</div>
@endsection 
 