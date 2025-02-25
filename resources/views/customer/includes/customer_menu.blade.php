{{-- <div class="card">
    <div class="card-header">
         <a href="{{route('customer.profile',encrypt($customer->id))}}" class="btn btn-secondary mx-1 btn-md">Status</a>
         <a href="{{route('customer.profile.about',encrypt($customer->id))}}" class="btn btn-primary  mx-1 btn-md">About</a>
         <button class="btn btn-primary  mx-1 btn-md">File & Document</button>
         <button class="btn btn-primary  mx-1 btn-md">Payment History</button> 
    </div>
 </div> --}}

 <div class="row">
     <div class="col-md-6"> 
         <div class="card">
             <div class="card-body">
                 <div class="d-flex">
                     <div class="flex-shrink-0 align-self-center">
                         <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                             <span class="avatar-title">
                                 <i class="mdi mdi-chart-line fs-24"></i> 
                             </span>
                         </div>
                     </div>
                     <div class="flex-grow-1 ms-3">
                         <p class="text-muted fw-medium mb-2">Purchase Possibility</p>
                         <h4 class="mb-0">{{$customer->purchase_possibility}}</h4>
                     </div>
                 </div>
             </div>
         </div>
     </div>
    
     <div class="col-md-6"> 
         <div class="card">
             <div class="card-body">
                 <div class="d-flex">
                     <div class="flex-shrink-0 align-self-center">
                         <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                             <span class="avatar-title">
                                 <i class="mdi mdi-chart-line fs-24"></i> 
                             </span>
                         </div>
                     </div>
                     <div class="flex-grow-1 ms-3">
                         <p class="text-muted fw-medium mb-2">Last Step</p>
                         <h4 class="mb-0">
                            @if($customer->last_stpe==1 || $customer->last_stpe==null)
                                Customer Entry
                            @elseif($customer->last_stpe==2)
                                Prospecting
                            @elseif($customer->last_stpe==3)
                                Cold Calling
                            @elseif($customer->last_stpe==4)
                                Lead
                            @elseif($customer->last_stpe==5)
                                Presentation
                            @elseif($customer->last_stpe==6)
                                Followup
                            @elseif($customer->last_stpe==7)
                                Negotiation
                            @elseif($customer->last_stpe==8)
                                Rejection
                            @elseif($customer->last_stpe==9)
                                Sales 
                            @endif
                         </h4>
                     </div>
                 </div>
             </div>
         </div>
     </div> 
 </div>