<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"> 
        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
    </a> 
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{ route('invoice.show', encrypt($data->id)) }}">Details</a> 
        @if ($data->status==0)
            <a class="dropdown-item" href="{{ route('invoice.edit', encrypt($data->id)) }}">Edit</a> 
        @endif 
        <a href="javascript:void(0)"  class="dropdown-item"  onclick="shareLink('{{ encrypt($data->id) }}', '{{ $data->user->phone }}')">Share</a>
        
        @can('deposit')
            @if ($data->status != 1)
                <a class="dropdown-item" href="{{ route('deposit.create', ['invoice_id'=> encrypt($data->id)]) }}">Make Payment</a> 
            @endif 
        @endcan  
    </div>
</div>
