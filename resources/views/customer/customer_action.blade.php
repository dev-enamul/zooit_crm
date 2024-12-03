<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        {{-- @if($data->approve_by!=null)
            <i class="fas fa-check"></i>
        @endif --}}
        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
    </a> 
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{ route('followup.create', ['customer' => $data->id]) }}">Follow Up</a> 
        <a class="dropdown-item" href="{{route('salse.create',['customer'=>$data->id])}}">Salse</a>  
        <a class="dropdown-item" href="{{route('meeting.create',['customer'=>$data->id])}}">Meeting</a>
        {{-- <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$data->user_id}}')">WhatsApp Message</a> --}}
        <a href="https://api.whatsapp.com/send/?phone={{$data->phone}}">WhatsApp Message</a>

        <a class="dropdown-item" href="{{ route('customer.edit',encrypt($data->id)) }}">Edit</a> 
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->id))}}">View Profile</a>  
        <a class="dropdown-item" href="{{route('rejection.create',['customer'=>$data->id])}}">Rejection</a>
        @if ($data->customer_id==null)
            <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',encrypt($data->id)) }}')">Delete</a>  
        @endif 
    </div>
</div>
