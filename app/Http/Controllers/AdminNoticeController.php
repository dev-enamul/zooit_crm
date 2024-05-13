<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Notification::where('created_by', auth()->user()->id)->paginate(10);
        $employees = User::where('user_type',1)->where('status',1)->get();
        return view('notification.admin_notice',compact('datas','employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['created_by'] = Auth::user()->id;
        Notification::store($data);
        return redirect()->back()->with('success','Notification sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
