<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositReportController extends Controller
{
    public function salse_executive(){
        return view('report.deposit.salse_executive');
    }

    public function asm_dsm(){
        return view('report.deposit.asm_dsm');
    }

    public function area_incharge(){
        return view('report.deposit.area_incharge');
    }
}
