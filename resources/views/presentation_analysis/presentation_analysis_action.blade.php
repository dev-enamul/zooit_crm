<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($visit->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$visit->customer->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($visit->customer_id))}}">Customer Profile</a>
        @can('visit-analysis-manage')
            <a class="dropdown-item" href="{{route('presentation_analysis.edit',$visit->id)}}">Edit</a>
        @endcan 

        @can('visit-analysis-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('visit.delete',$visit->id) }}')">Delete</a>
        @endcan 

        @if ($visit->approve_by!=null)
            <a class="dropdown-item" href="{{route('followup.create',['customer' => $visit->customer_id])}}">Follow Up</a>
        @endif

        <a class="dropdown-item" href="{{route('presentation.analysis.details', encrypt($visit->id))}}">Print Visit Analysis</a>
    </div>
</div>
