<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\Concerns\NormalizesLocalSeoInput;
use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistrictRequest extends FormRequest
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
            'typical_issues' => $this->cleanRowList($this->input('typical_issues'), ['issue', 'cause', 'solution'], 'issue'),
            'is_active'      => $this->boolean('is_active'),
            'is_indexable'   => $this->boolean('is_indexable'),
        ]);
    }

    public function rules(): array
    {
        $district = $this->route('district');
        $ignoreId = $district instanceof District ? $district->id : null;

        return [
            'city_id'            => ['required', 'integer', 'exists:cities,id'],
            'name'               => ['required', 'string', 'max:120'],
            'slug'               => [
                'required', 'alpha_dash', 'max:120',
                Rule::unique('districts', 'slug')->where('city_id', (int) $this->input('city_id'))->ignore($ignoreId),
            ],
            'postal_code'        => ['nullable', 'string', 'max:10'],
            'latitude'           => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'          => ['nullable', 'numeric', 'between:-180,180'],
            'landmarks'          => ['array', 'max:12'],
            'landmarks.*'        => ['string', 'max:100'],
            'typical_issues'     => ['array', 'max:8'],
            'typical_issues.*.issue'    => ['required', 'string', 'max:150'],
            'typical_issues.*.cause'    => ['nullable', 'string', 'max:300'],
            'typical_issues.*.solution' => ['required', 'string', 'max:400'],
            'soil_water_profile' => ['nullable', 'string', 'max:255'],
            'intro_override'     => ['nullable', 'string', 'max:5000'],
            'estimated_arrival'  => ['required', 'string', 'max:40'],
            'meta_title'         => ['nullable', 'string', 'max:255'],
            'meta_description'   => ['nullable', 'string', 'max:320'],
            'is_active'          => ['boolean'],
            'is_indexable'       => ['boolean'],
            'sort_order'         => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'slug.unique' => 'Slug kecamatan sudah dipakai di kota yang sama.',
            'typical_issues.*.solution.required' => 'Setiap masalah khas wajib memiliki solusi.',
        ];
    }
}
