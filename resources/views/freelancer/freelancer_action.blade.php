<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($data?->user?->approve_by!=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{$data?->user?->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">


        @can('freelancer-manage')
            <a class="dropdown-item" href="{{route('profile',encrypt($data?->user_id))}}">Profile</a>
            <a class="dropdown-item" href="{{route('freelancer.edit', encrypt($data->id))}}">Edit</a>
            <a class="dropdown-item" href="{{route('designation.freelancer.edit', encrypt($data?->user_id))}}">Change Designation</a>
            @if (($data->status==1 && $data?->user?->approve_by==null) || (auth()->user()->id==1 && $data?->user?->approve_by==null))
                @can('complete-training')
                    <a class="dropdown-item" href="javascript:void(0)" onclick="approveItem('{{route('complete.training',encrypt($data?->user_id))}}')">Complete Training</a>
                @endcan
            @elseif($data->status==1)
            @can('freelancer-delete')
                <a class="dropdown-item"  href="javascript:void(0)" onclick="deleteItem('{{ route('deactive.freelancer', encrypt($data?->user_id)) }}')">Resign Freelancer</a>
            @endcan
            <a class="dropdown-item" href="{{route('user.area.edit', encrypt($data?->user_id))}}">Change Area</a>
            @endif

            <a class="dropdown-item" href="{{route('reporting.user.edit', encrypt($data?->user_id))}}">Change Reporting User</a>
            <a class="dropdown-item" href="{{route('user.details', encrypt($data?->user_id))}}">Print Freelancer</a>
        @endcan

    </div>
</div>
