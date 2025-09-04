<div class="dropdown">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="actionMenu{{ $data->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs me-1"></i> Actions
    </button>
    <ul class="dropdown-menu" aria-labelledby="actionMenu{{ $data->id }}">
        {{-- <li>
            <a class="dropdown-item" href="{{ route('salse.details', encrypt($data->id)) }}">
                <i class="fas fa-file-alt me-1"></i> Sales Details
            </a>
        </li> --}}
        <li>
            <a class="dropdown-item" href="{{ route('install.payment', encrypt($data->id)) }}">
                <i class="fas fa-calendar-alt me-1"></i> Scheduled Payment
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('service.payment', encrypt($data->id)) }}">
                <i class="fas fa-credit-card me-1"></i> Service Payment
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('instant.invoice', encrypt($data->id)) }}">
                <i class="fas fa-bolt me-1"></i> Instant Invoice
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ url('project-team', ['project_id' => encrypt($data->id)]) }}">
                <i class="fas fa-users me-1"></i> Team
            </a>
        </li>
    </ul>
</div>
