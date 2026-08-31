<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\WebpConverterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorUploadController extends Controller
{
    /**
     * Handle image upload requests from Rich Text / WYSIWYG Editors (TinyMCE, CKEditor, Summernote, etc.)
     * Automatically converts uploaded bitmap images to WebP format.
     */
    public function uploadImage(Request $request, WebpConverterService $webpService)
    {
        $request->validate([
            'file'   => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,bmp,svg|max:10240',
            'upload' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,bmp,svg|max:10240',
            'image'  => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,bmp,svg|max:10240',
        ]);

        $file = $request->file('file') ?? $request->file('upload') ?? $request->file('image');

        if (!$file) {
            return response()->json(['error' => 'No image file uploaded.'], 400);
        }

        $path = $webpService->convertAndStore($file, 'editor');
        $url  = Storage::url($path);

        return response()->json([
            'location' => $url,
            'url'      => $url,
            'uploaded' => true,
        ]);
    }
}
