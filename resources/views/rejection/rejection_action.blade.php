<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($data->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$data->customer->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->customer_id))}}">Customer Profile</a>
        <a class="dropdown-item" href="#" onclick="sendWhatsapp('{{$data->customer->user_id}}')">WhatsApp Message</a>
        {{-- @can('lead-manage')
            <a class="dropdown-item" href="{{route('lead.edit',$data->id)}}">Edit</a>
        @endcan 
        @can('lead-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('lead.delete',$data->id) }}')">Delete</a>
        @endcan 
        @if ($data->approve_by!=null && $data->status==0)
            @can('lead-analysis')
                <a class="dropdown-item" href="{{route('lead-analysis.create',['customer'=> $data->customer->id])}}">Lead Analysis Form</a>
            @endcan
        @endif  --}} 
        {{-- <a class="dropdown-item" href="{{route('customer.details', encrypt($data->customer_id))}}">Print Customer</a> --}}
    </div>
</div>
