<ul>
    @foreach ($organogram['downlines'] as $downline)
    <li  data-jstree='{ "opened" : true }'>
        {{ @$downline['user']->user->name }}
        @if (!empty($downline['downlines']))
        @include('includes.down_employee', ['organogram' => $downline])
    @endif
    </li>
    @endforeach
     
</ul>
 