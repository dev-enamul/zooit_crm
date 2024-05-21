<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($cold_calling->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$cold_calling->customer->user->image()}}">
    </a> 

    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($cold_calling->customer_id))}}">Customer Profile</a>
        @can('cold-calling-manage')
            <a class="dropdown-item" href="{{route('cold-calling.edit',$cold_calling->id)}}">Edit</a>
        @endcan

        @can('cold-calling-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('cold_calling.delete',$cold_calling->id) }}')">Delete</a>
        @endcan

        @if ($cold_calling->approve_by!=null && $cold_calling->status==0)
            @can('lead-manage')
                <a class="dropdown-item" href="{{route('lead.create',['customer' => $cold_calling->customer->id])}}">Lead</a>
            @endcan
        @endif
        <a class="dropdown-item" href="{{route('customer.details', encrypt($cold_calling->customer_id))}}">Print Customer</a>

    </div>
</div>
