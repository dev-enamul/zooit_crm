{{-- <style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style> --}}
<ul>
    @foreach ($organogram['downlines'] as $downline) 
    <li> 
        @php
            // $all_employee = my_all_employee($downline['user']->user->id);
            // $employee = \App\Models\User::whereIn('id',$all_employee)->where('user_type',1)->count();
            // $freelancer = \App\Models\User::whereIn('id',$all_employee)->where('user_type',2)->count();
        @endphp 
        
        <a href="{{route('employees.hierarchy2',['employee'=> encrypt($downline['user']->user->id)])}}" style="{{!empty($downline['downlines'])?'background:#ddd':''}}">
            <img src="{{@$downline['user']->user->image()}}">
            <span>{{ @$downline['user']?->user?->name }} <br>{{ @$downline['user']?->user?->user_id }}  <br>  
                {{-- Total Employee: {{ $employee }}
                <br>  
                Total Freelancer: {{ $freelancer }} </span>  --}}
        </a>  
        @if (!empty($downline['downlines']) && $depth > 1) 
            @include('includes.down_hierachy', ['organogram' => $downline,'depth' => $depth - 1])
        @endif
    </li> 
    @endforeach 
</ul>
 