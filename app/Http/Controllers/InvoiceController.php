<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
   
    public function index(InvoiceDataTable $dataTable, Request $request)
    {
        $title      = 'Prospecting List';
        $date       = $request->date ?? null;
        $status     = $request->status ?? 0;
        $start_date = Carbon::parse($date ? explode(' - ', $date)[0] : date('Y-m-01'))->format('Y-m-d');
        $end_date   = Carbon::parse($date ? explode(' - ', $date)[1] : date('Y-m-t'))->format('Y-m-d');
        if (isset($request->employee) && $request->employee != null) {
            $employee = User::find($request->employee);
        } else {
            $employee = User::find(auth()->user()->id);
        }   

        return $dataTable->render('invoice.invoice_list', compact('title', 'employee', 'status', 'start_date', 'end_date'));
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = decrypt($id);
        $invoice = Invoice::find($id);
        return view('invoice.invoice_details',compact('invoice'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $invoice = Invoice::find($id);
        return view('invoice.invoice_edit',compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $validator = Validator::make($request->all(), [
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'tax_amount' => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
        ]);  
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }  

    
        $invoice = Invoice::findOrFail($id); 
        $invoice->update([
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'title' => $request->title,
            'description' => $request->description, 
            'tax_amount' => $request->tax_amount,
            'discount_amount' => $request->discount_amount,
            'total_amount' => $invoice->amount + ($request->tax_amount - $request->discount_amount),
            'due_amount' => $invoice->amount + ($request->tax_amount - $request->discount_amount),  
        ]);
    
        return redirect()->route('invoice.show', encrypt($invoice->id))
                         ->with('success', 'Invoice updated successfully!');
    }   

    public function share($id){
        $id = customDecrypt($id);
        $invoice = Invoice::find($id);
        return view('invoice.share_invoice',compact('invoice'));
    } 
    
}
