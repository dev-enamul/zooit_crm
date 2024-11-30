<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($data->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$data->customer->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{ route('followup.create', ['customer' => $data->customer_id]) }}">Follow Up</a> 
        <a class="dropdown-item" href="{{route('salse.create',['customer'=>$data->customer_id])}}">Salse</a> 
        <a class="dropdown-item" href="{{route('meeting.create',['customer'=>$data->id])}}">Meeting</a>
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->customer_id))}}">Customer Profile</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$data->customer->user_id}}')">WhatsApp Message</a>
    </div>
</div>
