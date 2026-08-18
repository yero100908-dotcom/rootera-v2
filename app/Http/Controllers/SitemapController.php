<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ServiceCategory;
use App\Models\ServiceArea;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for the web application.
     *
     * @return Response
     */
    public function index(): Response
    {
        $articles = Article::published()->latest('updated_at')->get();
        $categories = ServiceCategory::where('is_active', true)->get();
        $areas = ServiceArea::where('is_active', true)->get();

        $content = view('sitemap', compact('articles', 'categories', 'areas'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }
}
