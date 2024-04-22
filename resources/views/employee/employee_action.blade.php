<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        <img class="rounded avatar-2xs p-0" src="{{$data->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">   
        @can('employee-manage')
            <a class="dropdown-item" href="{{route('profile', encrypt($data->id))}}">Profile</a>
            <a class="dropdown-item" href="{{route('employee.edit', encrypt($data->id))}}">Edit</a>
            <a class="dropdown-item" href="{{route('designation.user.edit', encrypt($data->id))}}">Change Designation</a>
            @can('employee-delete')
                <a class="dropdown-item"  href="javascript:void(0)" onclick="deleteItem('{{ route('deactive.user', encrypt($data->id)) }}')">Resign Employee</a>
            @endcan 
            <a class="dropdown-item" href="{{route('user.area.edit', encrypt($data->id))}}">Change Area</a>
            <a class="dropdown-item" href="{{route('reporting.user.edit', encrypt($data->id))}}">Change Reporting User</a>
            @can('employee-permission')
                <a class="dropdown-item" href="{{route('employee.permission', encrypt($data->id))}}">Change Permissin</a>
            @endcan  
            {{-- @can('refresh-password') --}}
                <a class="dropdown-item" href="{{route('refresh.password', encrypt($data->id))}}">Refresh Password</a>
            {{-- @endcan --}}
            <a class="dropdown-item" href="{{route('user.details', encrypt($data->id))}}">Print Employee</a>
        @endcan
    </div>
</div> 