<style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style>
<ul>
    @foreach ($organogram['downlines'] as $key => $downline)
    <li  data-jstree='{ "opened" : true }'>
        @if ($key ==0 && $downline['user']->user_type==2)
            
        @else
            <img class="rounded avatar-2xs p-0" src="{{@$downline['user']->user->image()}}">
            {{ @$downline['user']->user->name }}
            [{{ @$downline['user']->user->user_id }}] 
        @endif

        @if (!empty($downline['downlines']))
            @include('includes.down_employee', ['organogram' => $downline])
        @endif
    </li>
    @endforeach 
</ul>
 