<td class="text-center" data-bs-toggle="tooltip" title="Action"> 
    <div class="dropdown">
        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="rounded avatar-2xs p-0" src="{{@$followUp->customer->user->image()}}">
        </a>
        <div class="dropdown-menu dropdown-menu-animated">
            <a class="dropdown-item" href="{{route('customer.profile',encrypt($followUp->customer_id))}}">Customer Profile</a> 
            @if ($followUp->approve_by==null) 
                @can('follow-up-manage')
                    <a class="dropdown-item" href="{{route('followup.edit',$followUp->id)}}">Edit</a>
                @endcan 
            @endif
            @can('follow-up-delete')
                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('followUp.delete',$followUp->id) }}')">Delete</a> 
            @endcan 
            @if ($followUp->statis==0)
                <a class="dropdown-item" href="{{route('followup.create',['customer' => $followUp->customer_id])}}">Follow Up Again</a>
            @endif
            
            
            @if ($followUp->approve_by!=null) 
                @can('follow-up-analysis-manage')
                <a class="dropdown-item" href="{{route('followup-analysis.create',['customer'=>$followUp->customer->id])}}">Follow Up Analysis</a>
                @endcan 
            @endif 
        </div>
    </div> 
</td>