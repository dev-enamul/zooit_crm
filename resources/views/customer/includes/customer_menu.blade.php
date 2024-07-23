<div class="card">
    <div class="card-header">
         <a href="{{route('customer.profile',encrypt($customer->id))}}" class="btn btn-secondary mx-1 btn-md">Status</a>
         <button class="btn btn-primary  mx-1 btn-md">About</button>
         <button class="btn btn-primary  mx-1 btn-md">Wallet</button>
         <a href="{{route('customer.profile.contact',encrypt($customer->id))}}" class="btn btn-primary  mx-1 btn-md">Contact</a> 
         <button class="btn btn-primary  mx-1 btn-md">Crediansial</button>
    </div>
 </div>