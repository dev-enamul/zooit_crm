<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialOfferReportController extends Controller
{
    public function index(){
        return view('report.special_offer_report');
    }
}
