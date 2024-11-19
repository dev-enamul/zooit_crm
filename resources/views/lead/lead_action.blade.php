<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($lead->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$lead->customer->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($lead->customer_id))}}">Customer Profile</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$lead->customer->user_id}}')">WhatsApp Message</a>
        @can('lead-manage')
            <a class="dropdown-item" href="{{route('lead.edit',$lead->id)}}">Edit</a>
        @endcan

        @can('lead-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('lead.delete',$lead->id) }}')">Delete</a>
        @endcan

        @if ($lead->approve_by!=null && $lead->status==0)
            @can('presentation')
                <a class="dropdown-item" href="{{route('presentation.create',['customer'=> $lead->customer->id])}}">Presentation</a>
            @endcan
        @endif
        
        <a class="dropdown-item" href="{{route('customer.details', encrypt($lead->customer_id))}}">Print Customer</a>
    </div>
</div>
