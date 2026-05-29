<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header Section with Stats --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Categories</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and organize your content categories</p>
                </div>
                @can('create', App\Models\Category::class)
                    <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create New Category
                </a>
                @endcan
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Categories</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $categories->count() }}</p>
                        </div>
                        <div class="bg-blue-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Posts</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">
                                {{ $categories->flatMap(fn($cat) => $cat->posts->pluck('id'))->unique()->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Avg. Posts/Category</p>
                            <p class="text-2xl font-bold text-purple-600 mt-1">
                                {{ $categories->count() > 0 ? round($categories->sum(fn($cat) => $cat->posts->count()) / $categories->count(), 1) : 0 }}
                            </p>
                        </div>
                        <div class="bg-purple-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <x-alert type="success" :message="session('success')"></x-alert>
        @endif

        @if(session('error'))
            <x-alert type="danger" :message="session('error')"></x-alert>
        @endif

        @if(session('danger'))
            <x-alert type="danger" :message="session('danger')"></x-alert>
        @endif

        {{-- Categories Grid View (Card Layout) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="group bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    
                    {{-- Category Header with Icon --}}
                    <div class="relative h-40 bg-gradient-to-br from-blue-500 to-blue-400 flex items-center justify-center">
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl backdrop-blur-sm mb-2">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold text-xl">{{ $category->name }}</h3>
                        </div>
                        
                        {{-- Post Count Badge --}}
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center gap-1 bg-white/90 backdrop-blur-sm text-blue-600 px-2.5 py-1 rounded-lg text-xs font-semibold shadow-sm">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                {{ $category->posts->count() }} {{ Str::plural('Post', $category->posts->count()) }}
                            </span>
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="p-5">

                        {{-- Recent Posts Preview --}}
                        @if($category->posts->count() > 0)
                            <div class="mb-4">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-2">Recent posts</p>
                                <div class="space-y-1">
                                    @foreach($category->posts->take(2) as $post)
                                        <a href="{{ route('posts.show', $post) }}" class="block text-sm text-gray-600 hover:text-blue-600 transition truncate">
                                            • {{ $post->title }}
                                        </a>
                                    @endforeach
                                    @if($category->posts->count() > 2)
                                        <p class="text-xs text-gray-400 mt-1">+{{ $category->posts->count() - 2 }} more posts</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <a href="{{ route('categories.show', $category) }}" class="inline-flex items-center gap-1 text-sm text-gray-600 hover:text-blue-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Posts
                            </a>
                            
                            <div class="flex items-center gap-2">
                                @can('update', $category)
                                    <a href="{{ route('categories.edit', $category) }}" class="p-1.5 text-blue-400 hover:text-blue-600 transition rounded-lg" title="Edit Category">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                @endcan
                                
                                @can('delete', $category)
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category? This will remove it from all posts.');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 transition rounded-lg" title="Delete Category">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                                
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full">
                    <div class="text-center py-16 bg-white rounded-xl border border-gray-200">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">No categories yet</h3>

                        @can('create', App\Models\Category::class)
                            <p class="text-sm text-gray-500 mb-4">Get started by creating your first category.</p>
                            <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Create your first category
                            </a>
                        @endcan
                        
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($categories->hasPages())
            <div class="mt-8">
                {{ $categories->links() }}
            </div>
        @endif

    </div>
</x-app-layout>