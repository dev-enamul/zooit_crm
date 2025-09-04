<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Project;

class InvoiceService
{
     
    public function createInvoice($data, $details = [])
    {
        $project = Project::find($data['project_id']);
        
        $totalAmount     = $data['amount'] ?? 0;
        $totalAmountBdt  = $totalAmount;
        $totalAmountUsd  = null;
        $bdtRate         = null;

        if ($project && $project->currency === 'usd') {
            $bdtRate        = usd_to_bdt_rate();
            $totalAmountUsd = $totalAmount;
            $totalAmountBdt = $totalAmount * $bdtRate;
        }

        // Invoice তৈরি
        $invoice = Invoice::create([
            'user_id'         => $data['user_id'],
            'customer_id'     => $data['customer_id'],
            'project_id'      => $data['project_id'] ?? null,
            'title'           => $data['title'],
            'description'     => $data['description'] ?? null,
            'invoice_type'    => $data['invoice_type'] ?? 1,
            'invoice_date'    => $data['invoice_date'] ?? now()->format('Y-m-d'),
            'due_date'        => $data['due_date'] ?? now()->addDays(10),
            'amount'          => $totalAmount,
            'tax_amount'      => $data['tax_amount'] ?? 0,
            'discount_amount' => $data['discount_amount'] ?? 0,
            'total_amount_usd'=> $totalAmountUsd,
            'usd_rate'        => $bdtRate,
            'total_amount'    => round($totalAmountBdt),
            'due_amount'      => round($totalAmountBdt),
            'status'          => $data['status'] ?? 0,
        ]);
 
        foreach ($details as $detail) {
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'reason'     => $detail['reason'],
                'amount'     => $detail['amount'],
            ]);
        }

        return $invoice;
    }
}
