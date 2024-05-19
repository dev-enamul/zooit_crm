<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($presentation->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$presentation->customer->user->image()}}">
    </a>

    <div class="dropdown-menu dropdown-menu-animated">
        @can('presentation-manage')
            <a class="dropdown-item" href="{{route('presentation.edit',$presentation->id)}}">Edit</a>
        @endcan

        @can('presentation-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('presentation.delete',$presentation->id) }}')">Delete</a>
        @endcan

        <a class="dropdown-item" href="{{route('customer.profile',encrypt($presentation->customer_id))}}">Customer Profile</a>
        @if ($presentation->approve_by!=null)
        <a class="dropdown-item" href="{{route('followup.create',['customer' => $presentation->customer_id])}}">Follow Up</a>
            {{-- @if ($presentation->isVisited())
                @can('follow-up-manage')
                    <a class="dropdown-item" href="{{route('followup.create',['customer' => $presentation->customer_id])}}">Follow Up</a>
                @endcan
            @else
                @can('visit-analysis')
                    <a class="dropdown-item" href="{{route('presentation_analysis.create',['customer_id' => $presentation->customer_id])}}">Project Visit Analysis</a>
                @endcan
            @endif   --}}
        @endif
    </div>
</div>
