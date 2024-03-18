<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated"> 
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->id))}}">View Profile</a>
        @can('customer-manage') 
            <a class="dropdown-item" href="{{route('customer.edit',encrypt($data->id))}}" >Edit</a> 
        @endcan 

        @can('customer-delete')
            <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',encrypt($data->id)) }}')">Delete</a>
        @endcan
        
        @can('prospecting')
            @if ($data->approve_by!=null)
                <a class="dropdown-item" href="{{ route('prospecting.create', ['customer' => $data->id]) }}">Prospecting</a>
            @endif 
        @endcan  
        <a class="dropdown-item" href="{{route('customer.details', encrypt($data->id))}}">Print Customer</a>
    </div>
</div>