<td class="text-center" data-bs-toggle="tooltip" title="Action">
    <div class="dropdown">
        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"> 
            <img class="rounded avatar-2xs p-0" src="{{@$followUp->customer->user->image()}}">
        </a>
        <div class="dropdown-menu dropdown-menu-animated">
            <a class="dropdown-item" href="{{route('followup.create',['customer' => $followUp->customer_id])}}">Follow Up Again</a>
            <a class="dropdown-item" href="{{route('salse.create',['customer'=>$followUp->customer->id])}}">Salse</a>
            <a class="dropdown-item" href="{{route('meeting.create',['customer'=>$data->id])}}">Meeting</a>
            <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$followUp->customer->user_id}}')">WhatsApp Message</a> 
            <a class="dropdown-item" href="{{route('customer.profile',encrypt($followUp->customer_id))}}">Customer Profile</a> 
            <a class="dropdown-item" href="{{route('followup.edit',$followUp->id)}}">Edit</a>
            <a class="dropdown-item" href="{{route('rejection.create',['customer'=>$followUp->customer->id])}}">Rejection</a> 
        </div>
    </div>
</td>
