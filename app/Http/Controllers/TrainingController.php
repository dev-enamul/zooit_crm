<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    
    public function training_schedule_create(){
        return view('training.training_schedule_create');
    }

    public function training_schedule(){
        return view('training.training_schedule');
    }

    public function training_attendance(){
        return view('training.training_attendance');
    }

    public function training_history(){
        return view('training.training_history');
    }

    public function training_details(){
        return view('training.training_details');
    }
}
