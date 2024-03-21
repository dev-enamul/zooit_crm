<style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style>
<ul>
    @foreach ($organogram['downlines'] as $downline)
    <li  data-jstree='{ "opened" : true }'>
        <img class="rounded avatar-2xs p-0" src="{{@$downline['user']->user->image()}}">
        {{ @$downline['user']->user->name }}
        [{{ @$downline['user']->user->user_id }}] 

        @if (!empty($downline['downlines']) && $downline['user']->user->user_type==1)
            @include('includes.down_employee', ['organogram' => $downline])
        @endif
    </li>
    @endforeach 
</ul>
 