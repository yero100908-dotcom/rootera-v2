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

        $allFaqs = Faq::where('is_active', true)
            ->with('category')
            ->orderBy('sort_order')
            ->orderBy('id')
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
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.faq.index', compact('categories', 'allFaqs', 'featuredFaqs', 'searchResults', 'searchQuery', 'seo'));
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
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
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
            'og_image'    => asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.faq.show', compact('faq', 'relatedFaqs', 'seo'));
    }

    /**
     * Submit Interactive Feedback for single FAQ (/faq/{id}/feedback)
     */
    public function submitFeedback(Request $request, int $id)
    {
        $faq = Faq::where('is_active', true)->findOrFail($id);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'is_helpful' => 'required|boolean',
            'reason'     => 'nullable|string|max:255',
            'comment'    => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $sessionKey = 'faq_feedback_voted_' . $faq->id;

        if ($request->session()->has($sessionKey)) {
            return response()->json([
                'success' => true,
                'message' => 'Anda sudah memberikan feedback untuk pertanyaan ini.',
            ]);
        }

        \App\Models\FaqFeedback::create([
            'faq_id'     => $faq->id,
            'is_helpful' => $request->boolean('is_helpful'),
            'reason'     => $request->input('reason'),
            'comment'    => $request->input('comment'),
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->userAgent() ?? '', 0, 500),
        ]);

        $request->session()->put($sessionKey, true);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas masukan Anda!',
        ]);
    }
}
