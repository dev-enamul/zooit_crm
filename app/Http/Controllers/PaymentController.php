<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment($id){
        $id = customDecrypt($id);
        $invoice = Invoice::find($id);
        if(!$invoice){
            return redirect()->back('error',"Invalid Invoice");
        }

        $banks = Bank::where('status',1)->get(); 
        return view('invoice.invoice_payment',compact('invoice','banks'));
    }
}
