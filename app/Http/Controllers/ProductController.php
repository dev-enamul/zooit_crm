<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use App\Models\Village;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('product.product_list');
    }

    public function create(){
        $divisions = Division::pluck('name');
        $districts = District::pluck('name');
        $upazilas  = Upazila::pluck('name');
        $unions    = Union::pluck('name');
        $villages  = Village::pluck('name');
        return view('product.product_create', compact('divisions', 'districts', 'upazilas', 'unions', 'villages'));
    }

    public function store (Request $request){
        dd($request->all());
        return redirect()->route('product.index');
    }

    public function sold_unsold(){
        return view('product.sold_unsold');
    }
}
