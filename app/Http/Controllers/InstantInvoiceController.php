<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\Project;
use Illuminate\Http\Request;

class InstantInvoiceController extends Controller
{
    public function index($customerId)
    { 
        $id = decrypt($customerId);
        if (!$id) {
            return redirect()->back()->with('error', 'Invalid Sale ID');
        }  
        $customer = Customer::find($id); 
        if (!$customer) {
            return redirect()->back()->with('error', 'Invalid Sale ID');
        } 
        return view('invoice.instant_invoice', compact('customer'));
    }

    public function store(Request $request)
    { 
        $request->validate([
            'customer_id'       => 'required|exists:customers,id',
            'title'             => 'required|string|max:255',
            'due_date'          => 'required|date|after_or_equal:today',
            'reason'            => 'required|array|min:1',
            'reason.*'          => 'required|string|max:255',
            'amount'            => 'required|array|min:1',
            'amount.*'          => 'required|numeric|min:0',
        ]);
 
        $totalAmount = array_sum($request->amount);
  
        $invoice =  Invoice::create([
            'user_id'        => auth()->id(),
            'invoice_type'   => 1, 
            'customer_id'    => $request->customer_id,
            'project_id'     => $request->project_id ?? null, 
            'title'          => $request->title,
            'description'    => $request->description ?? null,
            'invoice_date'   => now()->format('Y-m-d'),
            'due_date'       => $request->due_date,
            'amount'         => $totalAmount,
            'tax_amount'     => 0,
            'discount_amount'=> 0,
            'total_amount'   => $totalAmount,
            'due_amount'     => $totalAmount,
            'status'         => 0, // Unpaid
        ]);

        // Invoice details যোগ করা
        foreach ($request->reason as $index => $reason) {
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'reason'     => $reason,
                'amount'     => $request->amount[$index],
            ]);
        } 
        return redirect()->route('invoice.show', encrypt($invoice->id))
                         ->with('success', 'Invoice created successfully.'); 
    }

}
