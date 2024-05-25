<div class="dropdown">
    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
        @if($lead->approve_by !=null)
            <i class="fas fa-check"></i>
        @endif
        <img class="rounded avatar-2xs p-0" src="{{@$lead->customer->user->image()}}">
    </a>
    <div class="dropdown-menu dropdown-menu-animated">
        <a class="dropdown-item" href="{{route('customer.profile',encrypt($lead->customer_id))}}">Customer Profile</a>
        @can('lead-analysis-manage')
            <a class="dropdown-item" href="{{route('lead-analysis.edit',$lead->id)}}">Edit</a>
        @endcan

        @can('lead-analysis-delete')
            <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('lead_analysis.delete',$lead->id) }}')">Delete</a>
        @endcan

        @if ($lead->approve_by!=null && $lead->status==0)
            <a class="dropdown-item" href="{{route('presentation.create',['customer'=> $lead->customer->id])}}">Entry Presentation</a>
            <a class="dropdown-item" href="{{route('presentation_analysis.create',['customer'=> $lead->customer->id])}}">Entry Project Visit</a>
        @endif

        <a class="dropdown-item" href="{{route('lead.analysis.details', encrypt($lead->id))}}">Lead Analysis Print</a>
    </div>
</div>
