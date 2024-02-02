<!DOCTYPE html>
<html>
<head>
    <title>Organogram</title>
    <!-- Add your CSS styles here -->
</head>
<body>

{{-- <h1>Organogram</h1> --}}

<ul>
    @foreach ($organogram['downlines'] as $downline)
        <li>
            {{ $downline['user']->user->name }}
            @if (!empty($downline['downlines']))
                @include('organogram', ['organogram' => $downline])
            @endif
        </li>
    @endforeach
</ul>

</body>
</html>
