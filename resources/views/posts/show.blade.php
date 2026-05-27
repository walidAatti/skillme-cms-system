<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition group">
                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to all posts
            </a>
        </div>

        {{-- Main Article Card --}}
        <article class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            
            {{-- Featured Image --}}
            @if($post->featured_image)
                <div class="relative h-64 md:h-96 lg:h-[32rem] overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-full object-cover">
                    
                    {{-- Status Badge Overlay --}}
                    <div class="absolute top-4 right-4">
                        @switch($post->status)
                            @case('published')
                                <span class="inline-flex items-center gap-1.5 bg-green-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Published
                                </span>
                                @break
                            @case('draft')
                                <span class="inline-flex items-center gap-1.5 bg-amber-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Draft
                                </span>
                                @break
                            @default
                                <span class="bg-gray-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-lg">
                                    {{ ucfirst($post->status) }}
                                </span>
                        @endswitch
                    </div>
                </div>
            @else
                {{-- Placeholder when no featured image --}}
                <div class="relative h-64 md:h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-20 h-20 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500 text-sm">No featured image</p>
                    </div>
                    
                    @switch($post->status)
                        @case('published')
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center gap-1.5 bg-green-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Published
                                </span>
                            </div>
                            @break
                        @case('draft')
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center gap-1.5 bg-amber-500/90 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    Draft
                                </span>
                            </div>
                            @break
                    @endswitch
                </div>
            @endif

            {{-- Content Area --}}
            <div class="p-6 md:p-8 lg:p-10">
                
                {{-- Meta Information --}}
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 mb-4 pb-4 border-b border-gray-100">
                    {{-- author --}}
                    <div class="flex items-center gap-1.5">
                        <span class="text-gray-400">Author:</span>
                        <span class="font-bold text-sm text-gray-500"> {{ $post->user->name }}</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $post->title }}
                </h1>

                {{-- Categories --}}
                @if($post->categories->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($post->categories as $category)
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium border border-blue-100">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>
                @endif

                {{-- Excerpt --}}
                @if($post->excerpt)
                    <div class="mb-8 p-5 bg-gray-50 rounded-xl border-l-4 border-blue-500 italic text-gray-700">
                        <svg class="w-5 h-5 text-blue-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                        {{ $post->excerpt }}
                    </div>
                @endif

                {{-- Content --}}
                <div class="prose prose-lg prose-blue max-w-none mb-8">
                    {!! $post->content !!}
                </div>

                {{-- Tags --}}
                @if($post->tags->isNotEmpty())
                    <div class="pt-6 border-t border-gray-100">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-semibold text-gray-700">Tags:</span>
                            @foreach($post->tags as $tag)
                                <span class="bg-purple-50 text-purple-700 px-3 py-1.5 rounded-lg text-sm font-medium border border-purple-100">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </article>

        {{-- Action Buttons --}}
        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                All Posts
            </a>
            
            <div class="flex gap-3">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Post
                    </a>
                @endcan
                
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 text-white bg-red-600 hover:bg-red-700 rounded-lg transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Post
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        {{-- Optional: Add some spacing for better readability --}}
        <div class="h-8"></div>

    </div>
</x-app-layout>