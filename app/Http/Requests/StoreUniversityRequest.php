<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Override;

class StoreUniversityRequest extends FormRequest
{

    #[Override]
    function prepareForValidation()
    {
        $slug = Str::slug($this->name);

        $this->merge([
            'slug' => $slug,
            'country_id' => $this->country_id,
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country_id' => ['required'],
            'name' => ['required', 'string', Rule::unique('universities', 'name')],
            'city' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('universities', 'slug')],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
            'about' => ['required', 'string'],
            'accommodation' => ['required', 'string'],
            'finance' => ['required', 'string'],
            'scholarships' => ['required', 'string'],
            'research' => ['nullable', 'string'],
            'pathway' => ['nullable', 'string'],
        ];
    }
}
