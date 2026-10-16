<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\Concerns\NormalizesLocalSeoInput;
use App\Models\ServiceAlias;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceAliasRequest extends FormRequest
{
    use NormalizesLocalSeoInput;

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'keyword'       => mb_strtolower(trim((string) $this->input('keyword', ''))),
            'slug'          => $this->slugOrFrom('slug', 'keyword'),
            'faq_overrides' => $this->cleanRowList($this->input('faq_overrides'), ['question', 'answer'], 'question'),
            'is_active'     => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        $alias = $this->route('serviceAlias');
        $ignoreId = $alias instanceof ServiceAlias ? $alias->id : null;

        return [
            'service_category_id' => ['required', 'integer', 'exists:service_categories,id'],
            'keyword'             => [
                'required', 'string', 'max:120',
                Rule::unique('service_aliases', 'keyword')
                    ->where('service_category_id', (int) $this->input('service_category_id'))
                    ->ignore($ignoreId),
            ],
            'slug'                => ['required', 'alpha_dash', 'max:120', Rule::unique('service_aliases', 'slug')->ignore($ignoreId)],
            'intent'              => ['required', Rule::in(ServiceAlias::INTENTS)],
            'usage'               => ['required', Rule::in(ServiceAlias::USAGES)],
            'search_volume'       => ['nullable', 'integer', 'min:0'],
            'intro_override'      => ['nullable', 'string', 'max:5000'],
            'faq_overrides'       => ['array', 'max:10'],
            'faq_overrides.*.question' => ['required', 'string', 'max:200'],
            'faq_overrides.*.answer'   => ['required', 'string', 'max:1000'],
            'is_active'           => ['boolean'],
        ];
    }
}
