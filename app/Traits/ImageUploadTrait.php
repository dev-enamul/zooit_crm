<?php
// app/Traits/ImageUploadTrait.php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    public function uploadImage(Request $request, $fieldName = 'image', $directory, $disk = 'public')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::disk($disk)->putFileAs($directory, $file, $fileName);
            return $directory.'/'.$fileName;
        }
        return null;
    }
    public function deleteImage($filePath, $disk = 'public')
    {
        if (Storage::disk($disk)->exists($filePath)) {
            Storage::disk($disk)->delete($filePath);
        }
    }
}
