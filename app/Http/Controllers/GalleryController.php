<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryPhoto;

class GalleryController extends Controller
{
    /**
     * Display a listing of the public gallery photos.
     */
    public function index()
    {
        // Get all active photos, sorted by sort_order
        $photos = GalleryPhoto::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get unique categories for the filter
        $categories = GalleryPhoto::where('is_active', true)
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->toArray();

        return view('pages.gallery', compact('photos', 'categories'));
    }
}
