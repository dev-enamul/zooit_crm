<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Services\InvoiceService;

class InstantInvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

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
            'customer_id' => 'required|exists:customers,id',
            'title'       => 'required|string|max:255',
            'paid_status'  => 'required|in:0,1',
            'due_date'    => 'nullable|date|after_or_equal:today',
            'reason'      => 'required|array|min:1',
            'reason.*'    => 'required|string|max:255',
            'amount'      => 'required|array|min:1',
            'amount.*'    => 'required|numeric|min:0',
        ]); 

        $totalAmount = array_sum($request->amount);

        $project = Project::where('customer_id', $request->customer_id)->first();
        if (!$project) {
            return redirect()->back()->withInput()->with('error', 'No project found for the selected customer.');
        }
 
        $details = collect($request->reason)->map(function ($reason, $index) use ($request) {
            return [
                'reason' => $reason,
                'amount' => $request->amount[$index],
            ];
        })->toArray();
 
        $invoice = $this->invoiceService->createInvoice([
            'user_id'      => auth()->id(),
            'customer_id'  => $request->customer_id,
            'project_id'   => $request->project_id ?? $project->id,
            'title'        => $request->title,
            'description'  => $request->description ?? null,
            'invoice_date' => now()->format('Y-m-d'),
            'due_date'     => $request->due_date?? now()->format('Y-m-d'),
            'amount'       => $totalAmount,
            'status'       => $request->paid_status
        ], $details);

        return redirect()->route('invoice.show', encrypt($invoice->id))
                         ->with('success', 'Invoice created successfully.');
    }
}
