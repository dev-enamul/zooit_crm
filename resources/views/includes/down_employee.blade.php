<style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style>
<ul>
    @php
        $step = 0;
    @endphp
    @foreach ($organogram['downlines'] as $downline)
    <li  data-jstree='{ "opened" : true }'>
        @if ($step==0 && $downline['user']->user_type==2)
            
        @else
            <img class="rounded avatar-2xs p-0" src="{{@$downline['user']->user->image()}}">
            {{ @$downline['user']->user->name }}
            [{{ @$downline['user']->user->user_id }}] 
        @endif

        @if (!empty($downline['downlines'])) 
            @php
                $step = 1;
            @endphp
            @include('includes.down_employee', ['organogram' => $downline])
        @endif
    </li>
    @endforeach 
</ul>
 