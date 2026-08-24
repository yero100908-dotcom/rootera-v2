<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $faqId = $this->route('faq') ? $this->route('faq')->id : null;

        return [
            'question' => 'required|string|max:500',
            'slug' => 'nullable|string|max:255|unique:faqs,slug,' . $faqId,
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_categories,id',
            'is_featured_home' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'question.required' => 'Pertanyaan FAQ wajib diisi.',
            'question.max' => 'Pertanyaan FAQ maksimal 500 karakter.',
            'slug.unique' => 'Slug URL pertanyaan sudah digunakan.',
            'answer.required' => 'Jawaban FAQ wajib diisi.',
            'faq_category_id.required' => 'Kategori FAQ wajib dipilih.',
            'faq_category_id.exists' => 'Kategori FAQ yang dipilih tidak valid.',
        ];
    }
}
