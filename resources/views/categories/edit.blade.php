<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Edit <span class="text-3xl md:text-4xl text-blue-900">{{ $category->name }}</span> Category</h1>
                </div>
                <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Cancel
                </a>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                
                {{-- Name --}}
                <div class="p-6 border-b border-gray-200">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Name <span class="text-red-500">*</span>
                    </label>
                        <input type="text" 
                            name="name" 
                            id="name" 
                            value="{{ $category->name }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror"
                            placeholder="Enter your category name"
                            required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                </div>
            </div>


            {{-- Form Actions --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('categories.index') }}" 
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                    Create Category
                </button>
            </div>
        </form>
    </div>

</x-app-layout>