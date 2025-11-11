<?php

namespace App\Http\Controllers;

use App\DataTables\InvoiceDataTable;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return $dataTable->render('invoice.invoice_list', compact('title','status', 'start_date', 'end_date'));
    }
 
    public function show(string $id)
    {
        $id = decrypt($id);
        $invoice = Invoice::with('transactions')->find($id);
        return view('invoice.invoice_details',compact('invoice')); 
    }

    public function edit(string $id)
    { 
        $id = decrypt($id);
        $invoice = Invoice::with('project')->find($id); 
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
            'reason' => 'required|array',
            'reason.*' => 'required|string',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric|min:0',
            'tax_amount' => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
            'usd_rate' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', $validator->errors()->first());
        }

        $invoice = Invoice::findOrFail($id);

        DB::beginTransaction();
        try {
            $totalAmount = array_sum($request->amount);
            $totalAmountWithTaxAndDiscount = $totalAmount + $request->tax_amount - $request->discount_amount;

            // Check if project currency is USD
            $currency = $invoice->project->currency ?? 'bdt';
            $isUsd = $currency === 'usd';

            if ($isUsd) {
                // When currency is USD, amounts entered are in USD
                // Use existing rate from database, not from form
                $usdRate = $request->usd_rate??$invoice->usd_rate;
                
                if (!$usdRate) {
                    // If no existing rate, fetch current rate
                    $usdRate = usd_to_bdt_rate();
                }
                
                $totalAmountUsd = $totalAmountWithTaxAndDiscount;
                $totalAmountBdt = $totalAmountWithTaxAndDiscount * $usdRate;
                
                $invoice->update([
                    'invoice_date' => $request->invoice_date,
                    'due_date' => $request->due_date,
                    'title' => $request->title,
                    'description' => null,
                    'amount' => $totalAmount,
                    'tax_amount' => $request->tax_amount,
                    'discount_amount' => $request->discount_amount,
                    'total_amount_usd' => $totalAmountUsd,
                    'usd_rate' => $usdRate, 
                    'total_amount' => round($totalAmountBdt),
                    'due_amount' => round($totalAmountBdt),
                ]);
            } else {
                // When currency is BDT, amounts are in BDT
                $invoice->update([
                    'invoice_date' => $request->invoice_date,
                    'due_date' => $request->due_date,
                    'title' => $request->title,
                    'description' => null,
                    'amount' => $totalAmount,
                    'tax_amount' => $request->tax_amount,
                    'discount_amount' => $request->discount_amount,
                    'total_amount' => $totalAmountWithTaxAndDiscount,
                    'due_amount' => $totalAmountWithTaxAndDiscount,
                    'usd_rate' => null,
                    'total_amount_usd' => null,
                ]);
            }

            $invoice->details()->delete();

            foreach ($request->reason as $key => $reason) {
                $invoice->details()->create([
                    'reason' => $reason,
                    'amount' => $request->amount[$key],
                ]);
            }

            DB::commit();

            return redirect()->route('invoice.show', encrypt($invoice->id))
                ->with('success', 'Invoice updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the invoice. Please try again.');
        }
    }

    public function share($id){
        $id = customDecrypt($id);
        $invoice = Invoice::find($id);
        return view('invoice.share_invoice',compact('invoice'));
    } 

    public function getUnpaidInvoicesByCustomer($customerId)
    {
        $invoices = Invoice::where('user_id', $customerId)
                            ->whereIn('status', [0, 2]) // 0=Unpaid, 2=Partial
                            ->get(['id', 'due_amount', 'due_date']);

        // Encrypt the ID for the share link
        $invoices->each(function ($invoice) {
            $invoice->encrypted_id = customEncrypt($invoice->id);
        });

        return response()->json($invoices);
    } 
    
}
