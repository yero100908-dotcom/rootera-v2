<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $status = $request->input('status');

        $query = Faq::with('category')->orderBy('sort_order')->orderBy('created_at', 'desc');

        if (!empty($categoryId)) {
            $query->where('faq_category_id', $categoryId);
        }

        if ($status !== null && $status !== '') {
            $query->where('is_active', (bool)$status);
        }

        $faqs = $query->paginate(20);
        $categories = FaqCategory::orderBy('sort_order')->get();

        return view('admin.faqs.index', compact('faqs', 'categories', 'categoryId', 'status'));
    }

    public function store(StoreFaqRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = empty($data['slug']) ? Str::slug($data['question']) : Str::slug($data['slug']);
            $data['is_featured_home'] = $request->boolean('is_featured_home');
            $data['is_active'] = $request->boolean('is_active', true);
            $data['sort_order'] = $data['sort_order'] ?? 0;

            Faq::create($data);

            DB::commit();
            $this->clearFaqCache();

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan FAQ: ' . $e->getMessage());
        }
    }

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = empty($data['slug']) ? Str::slug($data['question']) : Str::slug($data['slug']);
            $data['is_featured_home'] = $request->boolean('is_featured_home');
            $data['is_active'] = $request->boolean('is_active');
            $data['sort_order'] = $data['sort_order'] ?? 0;

            $faq->update($data);

            DB::commit();
            $this->clearFaqCache();

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui FAQ: ' . $e->getMessage());
        }
    }

    public function toggleActive(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);
        $this->clearFaqCache();

        return response()->json([
            'success'   => true,
            'is_active' => $faq->is_active,
            'message'   => $faq->is_active ? 'FAQ diaktifkan.' : 'FAQ dinonaktifkan.',
        ]);
    }

    public function destroy(Faq $faq)
    {
        DB::beginTransaction();
        try {
            $faq->delete();
            DB::commit();
            $this->clearFaqCache();

            return redirect()->route('admin.faqs.index')
                ->with('success', 'FAQ berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }

    private function clearFaqCache(): void
    {
        Cache::forget('home_featured_faqs');
        Cache::forget('all_faq_categories');
    }
}
