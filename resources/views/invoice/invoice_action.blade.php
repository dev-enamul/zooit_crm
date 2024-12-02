<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"> 
        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
    </a> 
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{ route('invoice.show', encrypt($data->id)) }}">Details</a> 
        @if ($data->status==0 || $data->status==2)
            <a class="dropdown-item" href="{{ route('invoice.edit', encrypt($data->id)) }}">Edit</a> 
        @endif 
        <a href="javascript:void(0)"  class="dropdown-item"  onclick="shareLink('{{ encrypt($data->id) }}', '{{ $data->user->phone }}')">Share</a>
        <a class="dropdown-item" href="{{ route('deposit.create', ['invoice_id'=> encrypt($data->id)]) }}">Make Payment</a> 


        {{-- <a class="dropdown-item" href="{{route('salse.create',['customer'=>$data->id])}}">Salse</a>  
        <a class="dropdown-item" href="{{route('meeting.create',['customer'=>$data->id])}}">Meeting</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$data->user_id}}')">WhatsApp Message</a>
        <a class="dropdown-item" href="{{ route('customer.edit',encrypt($data->id)) }}">Edit</a> 
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->id))}}">View Profile</a>  
        <a class="dropdown-item" href="{{route('rejection.create',['customer'=>$data->id])}}">Rejection</a>
        @if ($data->customer_id==null)
            <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',encrypt($data->id)) }}')">Delete</a>  
        @endif  --}}
    </div>
</div>
