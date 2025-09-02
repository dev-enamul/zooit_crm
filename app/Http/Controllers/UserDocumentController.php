<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDocument;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDocumentController extends Controller
{
    use ImageUploadTrait;
    public function index($id){
        $user_id = decrypt($id);
        $user = User::find($user_id);
        $datas = UserDocument::where('user_id',$user_id)->get(); 
        return view('profile.document',compact('user','datas'));
    }

    public function store(Request $request){ 
        $file = $request->file('file');
        $fileType = $file->getClientMimeType();
        if ($request->hasFile('file')) {
            $file = $this->uploadImage($request, 'file', 'user_documents', 'public'); 
        } 
        $user_document = new UserDocument();
        $user_document->user_id = $request->user_id;
        $user_document->title = $request->title;
        $user_document->file = $file;
        $user_document->type = $fileType;
        $user_document->save();
        return redirect()->back()->with('success','Document Added Successfully');
    }
}
