<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Header Section with Stats --}}
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">Blog Posts</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage and view all your created content</p>
                </div>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium py-2.5 px-5 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Create New Post
                </a>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Posts</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $posts->total() }}</p>
                        </div>
                        <div class="bg-blue-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Published</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">{{ $posts->where('status', 'published')->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Drafts</p>
                            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $posts->where('status', 'draft')->count() }}</p>
                        </div>
                        <div class="bg-amber-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Categories</p>
                            <p class="text-2xl font-bold text-blue-900 mt-1">{{ \App\Models\Category::count() }}</p>
                        </div>
                        <div class="bg-blue-50 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <x-alert type="success" :message="session('success')"></x-alert>
        @endif

        @if(session('danger'))
            <x-alert type="danger" :message="session('danger')"></x-alert>
        @endif

        {{-- Posts Grid View (Card Layout) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <div class="group bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    {{-- Image Section --}}
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        
                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            @switch($post->status)
                                @case('published')
                                    <span class="inline-flex items-center gap-1 bg-green-500/90 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-medium shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Published
                                    </span>
                                    @break
                                @case('draft')
                                    <span class="inline-flex items-center gap-1 bg-amber-500/90 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-medium shadow-sm">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        Draft
                                    </span>
                                    @break
                                @default
                                    <span class="bg-gray-500/90 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-medium shadow-sm">
                                        {{ ucfirst($post->status) }}
                                    </span>
                            @endswitch
                        </div>
                    </div>

                    {{-- Content Section --}}
                    <div class="p-5">

                        {{-- author --}}
                        <div class="text-xs -mt-2 mb-3">
                            <span class="text-gray-400">Author:</span>
                            <span class="font-bold text-sm text-gray-500"> {{ $post->user->name }}</span>
                        </div>

                        {{-- Categories & Tags --}}
                        <div class="flex flex-wrap gap-1.5 mb-3">
                            @forelse($post->categories->take(3) as $category)
                                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded-full font-medium border border-blue-100">
                                    {{ $category->name }}
                                </span>
                            @empty
                                <span class="text-xs text-gray-400">No categories</span>
                            @endforelse
                            @if($post->tags->count())
                                <span class="text-xs text-gray-400">•</span>
                                @foreach($post->tags->take(3) as $tag)
                                    <span class="text-purple-600 text-xs font-medium">#{{ $tag->name }}</span>
                                @endforeach
                                @if($post->tags->count() > 1 && ($post->tags->count() - 3) > 0 )
                                    <span class="text-xs text-gray-400">+{{ $post->tags->count() - 3 }}</span>
                                @endif
                            @endif
                        </div>

                        {{-- Title --}}
                        <a href="{{ route('posts.show', $post) }}" class="block">
                            <h3 class="text-lg font-bold text-gray-900 hover:text-blue-600 transition line-clamp-2 mb-2">
                                {{ $post->title }}
                            </h3>
                        </a>

                        {{-- Excerpt --}}
                        <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                            {{ $post->excerpt ?? strip_tags($post->content) ?? 'No excerpt provided.' }}
                        </p>

                        {{-- Meta Info & Actions --}}
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div class="text-xs text-gray-400">
                                created<span class="text-gray-500"> {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <a href="{{ route('posts.show', $post) }}" class="p-1.5 text-gray-400 hover:text-gray-600 transition rounded-lg" title="View">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                {{-- authorize  --}}
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="p-1.5 text-blue-400 hover:text-blue-600 transition rounded-lg" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                @endcan
                                    
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-red-400 hover:text-red-600 transition rounded-lg" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
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
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">No posts yet</h3>
                        <p class="text-sm text-gray-500 mb-4">Get started by creating your first blog post.</p>
                        <a href="{{ route('posts.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Create your first post
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
</x-app-layout>