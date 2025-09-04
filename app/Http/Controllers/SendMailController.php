<?php

namespace App\Http\Controllers;

use App\Mail\GenericInvoiceMail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function sendMail(Request $request)
    {
        return view('emails.send-mail-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'to' => 'required|array',
            'to.*' => 'email',
            'cc' => 'nullable|array',
            'cc.*' => 'email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'invoice_ids' => 'nullable|array',
            'invoice_ids.*' => 'exists:invoices,id',
            'attachment' => 'nullable|string',
        ]);

        $toEmails = $request->to;
        $ccEmails = $request->cc ?? [];
        
        $invoices = collect();
        if ($request->has('invoice_ids')) {
            $invoices = Invoice::find($request->invoice_ids);
        }

        $attachmentPath = $request->attachment;

        try {
            Mail::to($toEmails)
                ->cc($ccEmails)
                ->send(new GenericInvoiceMail($request->subject, $request->message, $invoices, $attachmentPath));
            
            if ($invoices->isNotEmpty()) {
                foreach ($invoices as $invoice) {
                    $invoice->increment('notification_count');
                    $invoice->last_notification_date = now();
                    $invoice->save();
                }
            }
            return back()->with('success', 'Mail sent successfully!');
        } catch (\Exception $e) { 
            Log::error('Mail sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Please check your mail configuration and try again.');
        }
    }
}