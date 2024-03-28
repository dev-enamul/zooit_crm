{{-- <style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style> --}}
<ul>
    @foreach ($organogram['downlines'] as $downline) 
        @if (@$downline['user']->user->user_type==1)
        <li>
            <a href="{{route('employees.hierarchy',['employee'=> @$downline['user']->user->id])}}">
                <img src="{{@$downline['user']->user->image()}}">
                <span>{{ @$downline['user']?->user?->name }} <br>{{ @$downline['user']?->user?->user_id }} </span>
            </a>   
            @if (!empty($downline['downlines'])) 
                @include('includes.down_hierachy', ['organogram' => $downline,'depth' => $depth - 1])
            @endif
        </li>  
        @endif  
    @endforeach 
</ul>
 