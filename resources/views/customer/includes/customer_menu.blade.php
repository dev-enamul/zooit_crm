<div class="card">
    <div class="card-header">
         <a href="{{route('customer.profile',encrypt($customer->id))}}" class="btn btn-secondary mx-1 btn-md">Status</a>
         <a href="{{route('customer.profile.about',encrypt($customer->id))}}" class="btn btn-primary  mx-1 btn-md">About</a>
         <button class="btn btn-primary  mx-1 btn-md">File & Document</button>
         <button class="btn btn-primary  mx-1 btn-md">Payment History</button>
         {{-- <a href="{{route('customer.profile.contact',encrypt($customer->id))}}" class="btn btn-primary  mx-1 btn-md">Contact</a> 
         <button class="btn btn-primary  mx-1 btn-md">Crediansial</button> --}}
    </div>
 </div>

 <div class="row">
     <div class="col-md-4"> 
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
                         <h4 class="mb-0">0%</h4>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-4"> 
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
                         <p class="text-muted fw-medium mb-2">Purchase Date</p>
                         <h4 class="mb-0">2/2/2</h4>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-md-4"> 
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
                         <p class="text-muted fw-medium mb-2">Complete </p>
                         <h4 class="mb-0">Followup</h4>
                     </div>
                 </div>
             </div>
         </div>
     </div> 
 </div>