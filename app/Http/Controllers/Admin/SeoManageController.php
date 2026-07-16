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
            'meta_title'       => 'required|string|max:255',
            'meta_description' => 'required|string|max:160',
            'canonical_url'    => 'nullable|url|max:255',
            'is_indexable'     => 'nullable|boolean',
        ]);

        // Checkbox value handling
        $validated['is_indexable'] = $request->has('is_indexable');

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
