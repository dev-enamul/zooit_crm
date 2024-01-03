<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    public function floor_wise_sold(){
        return view('report.product.floor_wise_sold_report');
    }
    public function project_wise_sold(){
        return view('report.product.floor_wise_sold_report');
    }
}
