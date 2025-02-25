<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use Illuminate\Http\Request;

class UserContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'designation_id' => 'nullable|exists:designations,id',
            'email' => 'nullable|email|max:45',
            'gender' => 'nullable|integer',
            'religion' => 'nullable|integer',
            'dob' => 'nullable|date',
            'whatsapp' => 'nullable|string|max:25',
            'facebook' => 'nullable|string|max:100',
            'linkedin' => 'nullable|string|max:100',
            'twitter' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
        ]);

        UserContact::create([
            'user_id' => $request->user_id,
            'name' => $request->contact_name,
            'phone' => $request->phone,
            'designation_id' => $request->designation_id,
            'email' => $request->email,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'dob' => $request->dob,
            'imo_number' => $request->whatsapp,
            'facebook_id' => $request->facebook,
            'linkedin_id' => $request->linkedin,
            'twiter_id' => $request->twitter,
            'instragram_id' => $request->instagram,
        ]);

        return redirect()->back()->with('success', 'Contact saved successfully.');
    }

 
    public function update(Request $request)
    {
        $request->validate([ 
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:25',
            'designation_id' => 'nullable|exists:designations,id',
            'email' => 'nullable|email|max:45',
            'gender' => 'nullable|integer',
            'religion' => 'nullable|integer',
            'dob' => 'nullable|date',
            'whatsapp' => 'nullable|string|max:25',
            'facebook' => 'nullable|string|max:100',
            'linkedin' => 'nullable|string|max:100',
            'twitter' => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
        ]);
    
        $contact = UserContact::findOrFail($request->id);
    
        $contact->update([ 
            'name' => $request->contact_name,
            'phone' => $request->phone,
            'designation_id' => $request->designation_id,
            'email' => $request->email,
            'gender' => $request->gender,
            'religion' => $request->religion,
            'dob' => $request->dob,
            'imo_number' => $request->imo_number,
            'facebook_id' => $request->facebook,
            'linkedin_id' => $request->linkedin,
            'twiter_id' => $request->twitter,
            'instragram_id' => $request->instagram,
        ]);
    
        return redirect()->back()->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = UserContact::find($id);
        if(!$contact){
            return redirect()->back()->with('error', 'Contact not found');
        }
        $contact->delete();
        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
