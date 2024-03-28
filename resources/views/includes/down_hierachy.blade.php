{{-- <style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style> --}}
<ul>
    @foreach ($organogram['downlines'] as $downline) 
    <li>
        <a href="{{route('employees.hierarchy',['employee'=> @$downline['user']->user->id])}}" style="{{!empty($downline['downlines'])?'background:#ddd':''}}">
            <img src="{{@$downline['user']->user->image()}}">
            <span>{{ @$downline['user']?->user?->name }} <br>{{ @$downline['user']?->user?->user_id }} </span>
        </a>   
        @if (!empty($downline['downlines']) && $depth > 1) 
            @include('includes.down_hierachy', ['organogram' => $downline,'depth' => $depth - 1])
        @endif
    </li>  
    @endforeach 
</ul>
 