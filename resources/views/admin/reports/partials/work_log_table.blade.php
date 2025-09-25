<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Task Name</th>
                <th>Note</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration (hours)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workLogs as $log)
                <tr>
                    <td>{{ $log->project->name ?? '-' }}</td>
                    <td>{{ $log->task->name ?? '-' }}</td>
                    <td>{{ $log->note }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->start_time)->format('Y-m-d') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($log->start_time)->format('h:i A') }} -
                        @if($log->end_time)
                            {{ \Carbon\Carbon::parse($log->end_time)->format('h:i A') }}
                        @else
                            continue
                        @endif
                    </td>
                    <td>{{ gmdate('H:i:s', $log->duration * 60) }}</td>
                </tr>
            @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
