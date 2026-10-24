<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeoService;
use Illuminate\Http\Request;

class SeoManageController extends Controller
{
    /**
     * @var SeoService
     */
    protected $seoService;

    /**
     * SeoManageController constructor.
     *
     * @param SeoService $seoService
     */
    public function __construct(SeoService $seoService)
    {
        $this->seoService = $seoService;
    }

    /**
     * Display the SEO manager panel.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $seoPages = $this->seoService->getAllPages();
        return view('admin.seo.index', compact('seoPages'));
    }

    /**
     * Update SEO page metadata.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'meta_title'       => 'required|string|max:70',
            'meta_description' => 'required|string|max:160',
            'canonical_url'    => 'nullable|url|max:255',
            'is_indexable'     => 'nullable|boolean',
        ]);

        // Sanitasi empty string menjadi null agar fallback berjalan aman
        $validated['canonical_url'] = !empty($validated['canonical_url']) ? trim($validated['canonical_url']) : null;
        $validated['is_indexable']  = $request->boolean('is_indexable');

        try {
            $this->seoService->updatePage((int)$id, $validated);
            return redirect()->route('admin.seo.index')
                ->with('success', 'Metadata SEO berhasil diperbarui.');
        } catch (\Throwable $e) {
            return redirect()->route('admin.seo.index')
                ->with('error', 'Gagal memperbarui metadata: ' . $e->getMessage());
        }
    }
}
