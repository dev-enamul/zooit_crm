<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"> 
        <img class="rounded avatar-2xs p-0" src="{{$data->customer->user->image()}}">
    </a> 
    <div class="dropdown-menu dropdown-menu-animated"> 
        <a class="dropdown-item" href="#"  onclick="approveItem('{{ route('meeting.complete',$data->id) }}')">Complete</a>    
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$data->user_id}}')">WhatsApp Message</a>
        <a class="dropdown-item" href="{{ route('meeting.edit',encrypt($data->id)) }}">Edit</a>
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->id))}}">View Profile</a>   
        @if ($data->customer_id==null)
            <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',encrypt($data->id)) }}')">Delete</a>  
        @endif  
    </div>
</div>
