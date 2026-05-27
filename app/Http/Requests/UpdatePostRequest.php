<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    #[Override]
    protected function prepareForValidation()
        {
            // Only generate new slug if title has changed
            if ($this->title !== $this->post->title) {
                $slug = Str::slug($this->title);
                $count = Post::where('slug', 'like', $slug . '%')
                            ->where('id', '!=', $this->post->id)
                            ->count();

                if ($count) {
                    $slug = $slug . '-' . ($count + 1);
                }

                $this->merge([
                    'slug' => $slug,
                ]);
            } else {
                $this->merge([
                    'slug' => $this->post->slug,
                ]);
            }

            // Handle tags - convert to array and filter
            $tags = $this->input('tags', '');
            $tagsArray = array_filter(
                array_map('trim', explode(',', $tags))
            );
            
            $this->merge([
                'tags' => $tagsArray,
            ]);
        }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'string', Rule::unique('posts', 'slug')->ignore($this->post->id)],
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
