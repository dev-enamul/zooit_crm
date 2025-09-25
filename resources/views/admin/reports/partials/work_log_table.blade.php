<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Task Name</th>
                <th>Note</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Duration (minutes)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($workLogs as $log)
                <tr>
                    <td>{{ $log->project->name ?? 'N/A' }}</td>
                    <td>{{ $log->task->name ?? 'N/A' }}</td>
                    <td>{{ $log->note }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->start_time)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->end_time)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $log->duration }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No work logs found for this period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
