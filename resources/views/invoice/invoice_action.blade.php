<div class="dropdown">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="invoiceMenu{{ $data->id }}" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-cogs me-1"></i> Actions
    </button>
    <ul class="dropdown-menu dropdown-menu-animated" aria-labelledby="invoiceMenu{{ $data->id }}">
        @if ($data->status == 0)
            <li>
                <a class="dropdown-item" href="{{ route('invoice.edit', encrypt($data->id)) }}">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
            </li>
        @endif
        <li>
            <a class="dropdown-item" href="javascript:void(0)" onclick="shareLink('{{ customEncrypt($data->id) }}', '{{ $data->user->phone }}')">
                <i class="fas fa-share-alt me-1"></i> Share
            </a>
        </li>
        <li>
            <button class="dropdown-item" type="button" onclick="openSendMailModal({{ $data->user_id }}, '{{ customEncrypt($data->id) }}', '{{ $data->invoice_date }}', {{ $data->id }})">
                <i class="fas fa-paper-plane me-1"></i> Send Single Invoice
            </button>
        </li>
        <li>
            <button class="dropdown-item" type="button" onclick="openSendUnpaidInvoicesModal({{ $data->user_id }})">
                <i class="fas fa-file-invoice-dollar me-1"></i> Send Unpaid Invoices
            </button>
        </li>
        @can('deposit')
            @if ($data->status != 1)
                <li>
                    <a class="dropdown-item" href="{{ route('deposit.create', ['invoice_id'=> encrypt($data->id)]) }}">
                        <i class="fas fa-credit-card me-1"></i> Make Payment
                    </a>
                </li>
            @endif
        @endcan
    </ul>
</div>