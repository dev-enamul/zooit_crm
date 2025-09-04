<div class="dropdown">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="employeeMenu{{ $data->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user-cog me-1"></i> Actions
    </button>
    <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="employeeMenu{{ $data->id }}">
        @can('employee-manage')
            <li>
                <a class="dropdown-item" href="{{ route('profile', encrypt($data->id)) }}">
                    <i class="fas fa-id-badge me-1"></i> Profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('employee.edit', encrypt($data->id)) }}">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('designation.user.edit', encrypt($data->id)) }}">
                    <i class="fas fa-user-tag me-1"></i> Change Designation
                </a>
            </li>
            @can('employee-delete')
                <li>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('deactive.user', encrypt($data->id)) }}')">
                        <i class="fas fa-user-slash me-1"></i> Resign Employee
                    </a>
                </li>
            @endcan
            <li>
                <a class="dropdown-item" href="{{ route('reporting.user.edit', encrypt($data->id)) }}">
                    <i class="fas fa-exchange-alt me-1"></i> Change Reporting User
                </a>
            </li>
            @can('employee-permission')
                <li>
                    <a class="dropdown-item" href="{{ route('employee.permission', encrypt($data->id)) }}">
                        <i class="fas fa-key me-1"></i> Change Permission
                    </a>
                </li>
            @endcan
            <li>
                <a class="dropdown-item" href="{{ route('refresh.password', encrypt($data->id)) }}">
                    <i class="fas fa-sync-alt me-1"></i> Refresh Password
                </a>
            </li>
            {{-- <li><a class="dropdown-item" href="{{ route('user.details', encrypt($data->id)) }}">Print Employee</a></li> --}}
        @endcan
    </ul>
</div>
