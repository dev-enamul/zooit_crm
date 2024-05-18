<td class="text-center" data-bs-toggle="tooltip" title="Action">
    <div class="dropdown">
        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
            @if($negotiation->approve_by !=null)
                <i class="fas fa-check"></i>
            @endif
            <img class="rounded avatar-2xs p-0" src="{{@$negotiation->customer->user->image()}}">
        </a>
        <div class="dropdown-menu dropdown-menu-animated">
            <a class="dropdown-item" href="{{route('customer.profile',$negotiation->customer_id)}}">Customer Profile</a>
            @can('negotiation-analysis-manage')
                <a class="dropdown-item" href="{{route('negotiation-analysis.edit',$negotiation->id)}}">Edit</a>
            @endcan
            @can('negotiation-analysis-delete')
                <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('negotiation.delete',$negotiation->id) }}')">Delete</a>
            @endcan
            @if ($negotiation->approve_by != null)
                @can('sales-manage')
                    <a class="dropdown-item" href="{{route('salse.create',['customer'=>$negotiation->customer->id])}}">Sales Create</a>
                @endcan
            @endif
            <a class="dropdown-item" href="{{route('negotiation.analysis.details', encrypt($negotiation->id))}}">Negotiation Analysis Print</a>
        </div>
    </div>
</td>
