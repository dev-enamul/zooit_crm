<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($presentation->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$presentation->customer->user->image()}}">
    </a>

    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($presentation->customer_id))}}">Customer Profile</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$presentation->customer->user_id}}')">WhatsApp Message</a>
        @can('presentation-manage')
            <a class="dropdown-item" href="{{route('presentation.edit',$presentation->id)}}">Edit</a>
        @endcan

        @can('presentation-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('presentation.delete',$presentation->id) }}')">Delete</a>
        @endcan 
        @if ($presentation->approve_by!=null)
            <a class="dropdown-item" href="{{route('followup.create',['customer' => $presentation->customer_id])}}">Follow Up</a>
        @endif
    </div>
</div>
