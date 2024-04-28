<style>
    .jstree-default .jstree-anchor { 
    height: 30px;
}
</style>
<ul>
    @foreach ($organogram['downlines'] as $downline)
    <li  data-jstree='{ "opened" : true }'>
        {{-- <img class="rounded avatar-2xs p-0" src="{{@$downline['user']->user->image()}}"> --}}
        {{ @$downline['user'] }} {{ @$downline['user']->id }}
        [{{ @$downline['user']->user->user_id }}] 

        @if (!empty($downline['downlines']))
            @include('includes.down_employee', ['organogram' => $downline])
        @endif
    </li>
    @endforeach 
</ul>
 