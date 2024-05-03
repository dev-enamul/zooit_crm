<td class="text-center" data-bs-toggle="tooltip" title="Action"> 
    <div class="dropdown">
        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="rounded avatar-2xs p-0" src="{{@$negotiation->customer->user->image()}}">
        </a>
        <div class="dropdown-menu dropdown-menu-animated">
            <a class="dropdown-item" href="{{route('customer.profile',encrypt($negotiation->customer_id))}}">Customer Profile</a> 
            @if ($negotiation->approve_by==null)
                @can('negotiation-manage')
                    <a class="dropdown-item" href="{{route('negotiation.edit',$negotiation->id)}}">Edit</a>
                @endcan
            @endif 
            
            @can('negotiation-delete')
                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('negotiation.delete',$negotiation->id) }}')">Delete</a> 
            @endcan
            
            @if ($negotiation->approve_by!=null)
                @can('negotiation-analysis-manage')
                    <a class="dropdown-item" href="{{route('negotiation-analysis.create',['customer'=>$negotiation->customer->id])}}">Negotiation Analysis</a>
                @endcan 
            @endif 
        </div>
    </div> 
</td>