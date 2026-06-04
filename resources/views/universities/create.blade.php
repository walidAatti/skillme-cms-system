<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Add New University</h1>
                    <p class="text-sm text-gray-500 mt-1">Add educational institution information</p>
                </div>
                <a href="{{ route('universities.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('universities.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                {{-- Basic Information Section --}}
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                    <p class="text-sm text-gray-500 mt-1">Core details about the university</p>
                </div>

                {{-- Country Selection --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="country_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Country <span class="text-red-500">*</span>
                    </label>
                    <select name="country_id" 
                            id="country_id" 
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('country_id') border-red-500 @enderror"
                            required>
                        <option value="">Select a country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- University Name --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        University Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror"
                           placeholder="e.g., Harvard University"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                </div>

                {{-- City --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">
                        City <span class="text-red-500">*</span>
                    </label>
                        <input type="text" 
                            name="city" 
                            id="city" 
                            value="{{ old('city') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('city') border-red-500 @enderror"
                            placeholder="e.g., Cambridge, MA"
                            required>
                    @error('city')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Logo Upload --}}
                <div class="p-6 border-b border-gray-200">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        University Logo
                    </label>
                    
                    {{-- Image Preview --}}
                    <div id="logoPreviewContainer" class="hidden mb-4">
                        <div class="relative inline-block">
                            <img id="logoPreview" src="#" alt="Logo Preview" class="h-32 w-auto rounded-lg border border-gray-200 object-cover">
                            <button type="button" id="removeLogo" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition shadow-lg">
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
                                <label for="logo" class="relative flex mx-auto cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>Upload a logo</span>
                                    <input id="logo" name="logo" type="file" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, WEBP up to 2MB (Recommended: 200x200)</p>
                        </div>
                    </div>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Detailed Information Section --}}
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-semibold text-gray-900">Detailed Information</h2>
                    <p class="text-sm text-gray-500 mt-1">Comprehensive details about the university</p>
                </div>

                {{-- About --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="about" class="block text-sm font-semibold text-gray-700 mb-2">
                        About the University
                    </label>
                    <textarea name="about" 
                              id="about" 
                              rows="5"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('about') border-red-500 @enderror"
                              placeholder="Write about the university's history, mission, values, and reputation...">{{ old('about') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">A comprehensive overview of the university.</p>
                    @error('about')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Accommodation --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="accommodation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Accommodation
                    </label>
                    <textarea name="accommodation" 
                              id="accommodation" 
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('accommodation') border-red-500 @enderror"
                              placeholder="Information about housing options, dormitories, off-campus housing...">{{ old('accommodation') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Details about student housing and accommodation options.</p>
                    @error('accommodation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Finance --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="finance" class="block text-sm font-semibold text-gray-700 mb-2">
                        Finance & Tuition
                    </label>
                    <textarea name="finance" 
                              id="finance" 
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('finance') border-red-500 @enderror"
                              placeholder="Tuition fees, cost of living, payment plans...">{{ old('finance') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Information about tuition fees and financial matters.</p>
                    @error('finance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Scholarships --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="scholarships" class="block text-sm font-semibold text-gray-700 mb-2">
                        Scholarships
                    </label>
                    <textarea name="scholarships" 
                              id="scholarships" 
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('scholarships') border-red-500 @enderror"
                              placeholder="Available scholarships, grants, financial aid opportunities...">{{ old('scholarships') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">List of scholarship opportunities and funding options.</p>
                    @error('scholarships')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Research --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="research" class="block text-sm font-semibold text-gray-700 mb-2">
                        Research Opportunities
                    </label>
                    <textarea name="research" 
                              id="research" 
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('research') border-red-500 @enderror"
                              placeholder="Research centers, labs, ongoing projects, publications...">{{ old('research') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Information about research facilities and opportunities.</p>
                    @error('research')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pathway Programs --}}
                <div class="p-6">
                    <label for="pathway" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pathway Programs
                    </label>
                    <textarea name="pathway" 
                              id="pathway" 
                              rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('pathway') border-red-500 @enderror"
                              placeholder="Foundation programs, English language courses, bridging programs...">{{ old('pathway') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Information about pathway programs and preparatory courses.</p>
                    @error('pathway')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Form Actions --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('universities.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                    Create University
                </button>
            </div>
        </form>
    </div>

    <script>

        // Logo preview
        const logoPreviewContainer = document.getElementById('logoPreviewContainer');
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logoPreview');
        const removeLogoBtn = document.getElementById('removeLogo');
        const uploadArea = document.getElementById('uploadArea');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                logoPreview.src = URL.createObjectURL(file);
                logoPreviewContainer.classList.remove('hidden');
                uploadArea.classList.add('bg-gray-50');
            }
        });

        removeLogoBtn.addEventListener('click', function() {
            logoInput.value = '';
            logoPreview.src = '';
            logoPreviewContainer.classList.add('hidden');
            uploadArea.classList.remove('bg-gray-50');
        });

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('border-blue-500', 'bg-blue-50');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('border-blue-500', 'bg-blue-50');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                logoInput.files = e.dataTransfer.files;
                const event = new Event('change');
                logoInput.dispatchEvent(event);
            }
        });
    </script>

</x-app-layout>