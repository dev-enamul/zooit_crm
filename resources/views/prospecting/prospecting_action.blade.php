<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="rounded avatar-2xs p-0" src="{{@$prospecting->customer->user->image()}}" alt="Header Avatar">
    </a>
    
    <div class="dropdown-menu dropdown-menu-animated"> 
        @can('prospecting-manage')
            @if ($prospecting->approve_by==null)
                <a class="dropdown-item" href="{{route('prospecting.edit',$prospecting->id)}}">Edit</a>
            @endif  
        @endcan
       

        @can('prospecting-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('prospecting.delete',$prospecting->id) }}')">Delete</a>  
        @endcan 
        @if ($prospecting->approve_by!=null) 
            @can('cold-calling-manage')
                <a class="dropdown-item" href="{{route('cold-calling.create',['customer' => $prospecting->customer->id])}}">Cold Calling</a>
            @endcan 
        @endif 
        <a class="dropdown-item" href="{{route('customer.details', encrypt($prospecting->customer_id))}}">Print Customer</a>
    </div>
</div> 