<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($prospecting->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$prospecting->customer->user->image()}}" alt="Header Avatar">
    </a>

    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($prospecting->customer_id))}}">Customer Profile</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$prospecting->customer->user_id}}')">WhatsApp Message</a>
        @can('prospecting-manage')
            <a class="dropdown-item" href="{{route('prospecting.edit',$prospecting->id)}}">Edit</a> 
        @endcan

        @can('prospecting-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('prospecting.delete',$prospecting->id) }}')">Delete</a>
        @endcan

        @if ($prospecting->approve_by!=null && $prospecting->status==0)
            @can('cold-calling-manage')
                <a class="dropdown-item" href="{{route('cold-calling.create',['customer' => $prospecting->customer->id])}}">Cold Calling</a>
            @endcan
        @endif

        <a class="dropdown-item" href="{{route('customer.details', encrypt($prospecting->customer_id))}}">Print Customer</a>
    </div>
</div>
