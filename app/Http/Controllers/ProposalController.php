<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index(){
        return view('proposal.proposal_view');
    }
}
