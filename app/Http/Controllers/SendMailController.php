<?php

namespace App\Http\Controllers;

use App\Mail\GenericInvoiceMail;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SendMailController extends Controller
{
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
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048'
        ]);

        $invoices = collect();
        if ($request->has('invoice_ids')) {
            $invoices = Invoice::whereIn('id', $request->invoice_ids)->get();
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('mail-attachments', 'public');
        }

        $mail = new GenericInvoiceMail(
            $request->subject,
            $request->message,
            $invoices,
            $attachmentPath
        );

        Mail::to($request->to)
            ->cc($request->cc ?? [])
            ->send($mail);

        // Clean up the attachment after sending
        if ($attachmentPath) {
            Storage::disk('public')->delete($attachmentPath);
        }

        return back()->with('success', 'Email sent successfully!');
    }
}