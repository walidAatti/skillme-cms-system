<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateUniversityRequest extends FormRequest
{
    function prepareForValidation()
    {
        $slug = Str::slug($this->university->name);

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
            'name' => ['required', 'string', Rule::unique('universities', 'name')->ignore($this->university->id)],
            'city' => ['required', 'string'],
            'slug' => ['required', 'string', Rule::unique('universities', 'slug')->ignore($this->university->id)],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
            'about' => ['required', 'string'],
            'accommodation' => ['required', 'string'],
            'finance' => ['required', 'string'],
            'scholarships' => ['required', 'string'],
            'research' => ['nullable', 'string'],
            'pathway' => ['nullable', 'string'],
        ];
    }
}
