<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Create New Post</h1>
                    <p class="text-sm text-gray-500 mt-1">Share your thoughts with the world</p>
                </div>
                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                {{-- Title --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('title') border-red-500 @enderror"
                           placeholder="Enter your post title"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    {{-- Slug Preview --}}
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="font-medium">Slug preview:</span> 
                        <span id="slugPreview" class="font-mono">{{ old('slug') ?: 'your-post-slug' }}</span>
                    </div>
                </div>

                

                {{-- Featured Image --}}
                <div class="p-6 border-b border-gray-200">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Featured Image
                    </label>
                    
                    {{-- Image Preview --}}
                    <div id="imagePreviewContainer" class="hidden mb-4">
                        <div class="relative inline-block">
                            <img id="imagePreview" src="#" alt="Preview" class="h-48 w-auto rounded-lg border border-gray-200 object-cover">
                            <button type="button" id="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- File Input --}}
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-500 transition cursor-pointer" id="uploadArea">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="featured_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a file</span>
                                    <input id="featured_image" name="featured_image" type="file" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, WBP, up to 5MB</p>
                        </div>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                        Excerpt <span class="text-xs font-normal text-gray-500">(Optional - Brief summary)</span>
                    </label>
                    <textarea name="excerpt" 
                              id="excerpt" 
                              rows="3"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('excerpt') border-red-500 @enderror"
                              placeholder="Write a short excerpt for your post...">{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">A brief summary that appears in blog listings (recommended 150-200 characters).</p>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" 
                              id="content" 
                              rows="12"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono text-sm @error('content') border-red-500 @enderror"
                              placeholder="Write your post content here... (HTML supported)"
                              required>{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categories --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="categories" class="block text-sm font-semibold text-gray-700 mb-2">
                        Categories
                    </label>
                    <select name="categories[]" 
                            id="categories" 
                            multiple
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('categories') border-red-500 @enderror"
                            size="5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">Hold Ctrl (Cmd on Mac) to select multiple categories.</p>
                    @error('categories')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tags --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tags
                    </label>
                        <input type="text" 
                            name="tags" 
                            id="tags" 
                            value="{{ old('tags') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('title') border-red-500 @enderror"
                            placeholder="Enter Tags separated by a comma (ex: study, uk, learn)"
                            
                        >
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="draft" 
                                   {{ old('status', 'draft') == 'draft' ? 'checked' : '' }}
                                   class="form-radio text-amber-600 focus:ring-amber-500">
                            <span class="ml-2 text-sm text-gray-700">Draft</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" 
                                   name="status" 
                                   value="published" 
                                   {{ old('status') == 'published' ? 'checked' : '' }}
                                   class="form-radio text-green-600 focus:ring-green-500">
                            <span class="ml-2 text-sm text-gray-700">Publish</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('posts.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                    Create Post
                </button>
            </div>
        </form>
    </div>

    <script>
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imageInput = document.getElementById('featured_image');
        const imagePreview = document.getElementById('imagePreview');
        const removeImageBtn = document.getElementById('removeImage');
        console.log(removeImageBtn, imagePreview, imagePreview, imageInput)


        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0]
            console.log(e.target.value)
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreviewContainer.style.display = 'block';
                console.log('photo added')
            } else {
                console.log('nothing is added')
            }

            removeImageBtn.addEventListener('click', function(e) {
                if (imageInput.value) {
                    imageInput.value = "";
                    imagePreview.src = "";
                    imagePreviewContainer.style.display = 'none';
                    console.log("Photo Deleted")
                } else {
                    console.log('nothing working')
                }
            })

        })
    </script> 

</x-app-layout>