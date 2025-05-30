<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
    </a> 
    
    <div class="dropdown-menu dropdown-menu-animated"> 
        <a class="dropdown-item" href="{{route('profile',encrypt($data?->user_id))}}">Profile</a>
        @if (auth()->user()->hasPermission('admin'))
            <a class="dropdown-item" href="{{route('freelancer.edit', encrypt($data->id))}}">Edit</a>
            <a class="dropdown-item" href="{{route('reporting.user.edit', encrypt($data?->user_id))}}">Change Reporting User</a>
        @endif 

        @can('freelancer-delete')
            <a class="dropdown-item"  href="javascript:void(0)" onclick="deleteItem('{{ route('deactive.freelancer', encrypt($data?->user_id)) }}')">Delete Freelancer</a>
        @endcan

        <a class="dropdown-item" href="javascript:void(0)" onclick="approveFreelancer({{$data->user_id}})">Approve</a> 
    </div>
</div> 