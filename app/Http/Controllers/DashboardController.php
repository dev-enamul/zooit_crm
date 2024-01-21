<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function index(){
        return view('index');
    }

    public function migrate_fresh(){
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }
}
