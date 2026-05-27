<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Override;
use Illuminate\Support\Str;

class StorePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    #[Override]
    protected function prepareForValidation()
    {
        $slug = Str::slug($this->title);

        $count = Post::where('slug', 'like', $slug .'%')->count();

        if ($count) {
            $slug = $slug . '-' . ($count + 1);
        }

        $this->merge([
            'slug' => $slug,
            'user_id' => Auth::id(),
            'tags' => array_filter(
                array_map('trim', explode(',', $this->tags))
            )
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'slug' => ['required', 'string', 'unique:posts,slug'],
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'status' => ['required', 'in:draft,published'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:50'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['exists:categories,id'],
        ];
    }
}
