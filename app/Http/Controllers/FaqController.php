<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Master Hub FAQ Knowledge Base (/faq)
     */
    public function index(Request $request)
    {
        $searchQuery = trim($request->input('q', ''));

        $categories = FaqCategory::where('is_active', true)
            ->withCount(['faqs' => function ($q) {
                $q->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->get();

        $featuredFaqs = Faq::where('is_active', true)
            ->where('is_featured_home', true)
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        $searchResults = collect();
        if (!empty($searchQuery)) {
            $searchResults = Faq::where('is_active', true)
                ->where(function ($q) use ($searchQuery) {
                    $q->where('question', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('answer', 'LIKE', "%{$searchQuery}%");
                })
                ->with('category')
                ->latest()
                ->get();
        }

        $seo = [
            'title'       => 'Pusat Bantuan & FAQ Saluran Mampet | Rootera Plumbing',
            'description' => 'Jawaban lengkap seputar estimasi biaya pelancaran pipa tersumbat, teknologi alat spiral & hydro-jetting, garansi 30 hari, dan layanan darurat 24 jam.',
            'canonical'   => route('faq.index'),
            'og_image'    => asset('images/logo final.png'),
        ];

        return view('pages.faq.index', compact('categories', 'featuredFaqs', 'searchResults', 'searchQuery', 'seo'));
    }

    /**
     * FAQ Category Page (/faq/kategori/{slug})
     */
    public function category(string $categorySlug)
    {
        $category = FaqCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->with(['faqs' => function ($q) {
                $q->where('is_active', true)->orderBy('sort_order')->orderBy('id');
            }])
            ->firstOrFail();

        $allCategories = FaqCategory::where('is_active', true)
            ->withCount(['faqs' => function ($q) {
                $q->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->get();

        $seo = [
            'title'       => "FAQ {$category->name} | Rootera Plumbing",
            'description' => $category->description,
            'canonical'   => route('faq.category', $category->slug),
            'og_image'    => asset('images/logo final.png'),
        ];

        return view('pages.faq.category', compact('category', 'allCategories', 'seo'));
    }

    /**
     * Single FAQ Detail Page (/faq/{slug})
     */
    public function show(string $faqSlug)
    {
        $faq = Faq::where('slug', $faqSlug)
            ->where('is_active', true)
            ->with('category')
            ->firstOrFail();

        $relatedFaqs = Faq::where('faq_category_id', $faq->faq_category_id)
            ->where('id', '!=', $faq->id)
            ->where('is_active', true)
            ->take(5)
            ->get();

        $seo = [
            'title'       => "{$faq->question} | FAQ Rootera Plumbing",
            'description' => \Illuminate\Support\Str::limit(strip_tags($faq->answer), 155),
            'canonical'   => route('faq.show', $faq->slug),
            'og_image'    => asset('images/logo final.png'),
        ];

        return view('pages.faq.show', compact('faq', 'relatedFaqs', 'seo'));
    }
}
