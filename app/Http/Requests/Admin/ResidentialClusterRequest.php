<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\Concerns\NormalizesLocalSeoInput;
use App\Models\ResidentialCluster;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResidentialClusterRequest extends FormRequest
{
    use NormalizesLocalSeoInput;

    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug'           => $this->slugOrFrom('slug', 'name'),
            'landmarks'      => $this->cleanStringList($this->input('landmarks')),
            'sub_clusters'   => $this->cleanStringList($this->input('sub_clusters')),
            'typical_issues' => $this->cleanRowList($this->input('typical_issues'), ['issue', 'cause', 'solution'], 'issue'),
            'district_ids'   => array_values(array_filter((array) $this->input('district_ids', []))),
            'is_active'      => $this->boolean('is_active'),
            'is_indexable'   => $this->boolean('is_indexable'),
        ]);
    }

    public function rules(): array
    {
        $cluster = $this->route('cluster');
        $ignoreId = $cluster instanceof ResidentialCluster ? $cluster->id : null;

        return [
            'city_id'           => ['required', 'integer', 'exists:cities,id'],
            'district_id'       => ['nullable', 'integer', 'exists:districts,id'],
            'district_ids'      => ['array'],
            'district_ids.*'    => ['integer', 'exists:districts,id'],
            'name'              => ['required', 'string', 'max:120'],
            'slug'              => ['required', 'alpha_dash', 'max:120', Rule::unique('residential_clusters', 'slug')->ignore($ignoreId)],
            'short_name'        => ['nullable', 'string', 'max:40'],
            'tier'              => ['required', Rule::in(ResidentialCluster::TIERS)],
            'developer'         => ['nullable', 'string', 'max:120'],
            'built_year'        => ['nullable', 'integer', 'between:1950,' . ((int) date('Y') + 5)],
            'latitude'          => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'         => ['nullable', 'numeric', 'between:-180,180'],
            'landmarks'         => ['array', 'max:12'],
            'landmarks.*'       => ['string', 'max:100'],
            'sub_clusters'      => ['array', 'max:30'],
            'sub_clusters.*'    => ['string', 'max:80'],
            'typical_issues'    => ['array', 'max:8'],
            'typical_issues.*.issue'    => ['required', 'string', 'max:150'],
            'typical_issues.*.cause'    => ['nullable', 'string', 'max:300'],
            'typical_issues.*.solution' => ['required', 'string', 'max:400'],
            'property_profile'  => ['nullable', 'string', 'max:255'],
            'estimated_arrival' => ['required', 'string', 'max:40'],
            'intro_override'    => ['nullable', 'string', 'max:5000'],
            'meta_title'        => ['nullable', 'string', 'max:70'],
            'meta_description'  => ['nullable', 'string', 'max:320'],
            'is_active'         => ['boolean'],
            'is_indexable'      => ['boolean'],
            'sort_order'        => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'typical_issues.*.solution.required' => 'Setiap masalah khas wajib memiliki solusi.',
            'slug.unique' => 'Slug cluster sudah digunakan.',
        ];
    }
}
