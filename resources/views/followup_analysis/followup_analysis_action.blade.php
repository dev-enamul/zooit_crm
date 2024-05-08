<td class="text-center" data-bs-toggle="tooltip" title="Action"> 
    <div class="dropdown">
        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="rounded avatar-2xs p-0" src="{{@$followUp->customer->user->image()}}">
        </a>
        <div class="dropdown-menu dropdown-menu-animated">
            <a class="dropdown-item" href="{{route('customer.profile',encrypt($followUp->customer_id))}}">Customer Profile</a> 
           @if ($followUp->approve_by==null)
                @can('follow-up-analysis-manage')
                    <a class="dropdown-item" href="{{route('followup-analysis.edit',$followUp->id)}}">Edit</a>
                @endcan 
           @endif  

            @can('follow-up-analysis-delete')
                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('followup-analysis.destroy',$followUp->id) }}')">Delete</a> 
            @endcan  

            @if ($followUp->approve_by!=null)
                 @can('negotiation-manage')
                    <a class="dropdown-item" href="{{route('negotiation.create',['customer'=>$followUp->customer->id])}}">Negotiation Create</a>
                 @endcan
            @endif  
            
            <a class="dropdown-item" href="{{route('followup.analysis.details', encrypt($followUp->id))}}">Follow-up Analysis Print</a>
        </div>
    </div> 
</td>