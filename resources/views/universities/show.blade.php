<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('universities.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="text-sm font-medium">Back to Universities</span>
            </a>
        </div>

        {{-- Hero Section --}}
        <div class="relative bg-gradient-to-br from-gray-200 via-gray-300 to-gray-400 rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative px-8 py-12 md:py-16">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        @if($university->logo)
                            <img src="{{ asset('storage/' . $university->logo) }}"
                                 alt="{{ $university->name }}"
                                 class="w-24 h-24 md:w-32 md:h-32 object-contain rounded-2xl border-4 border-white/30 bg-white shadow-2xl">
                        @else
                            <div class="w-24 h-24 md:w-32 md:h-32 bg-white/20 rounded-2xl border-2 border-white/30 flex items-center justify-center backdrop-blur-sm">
                                <span class="text-4xl md:text-5xl font-bold">{{ substr($university->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Info --}}
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-3">{{ $university->name }}</h1>
                        <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                            <span class="px-4 py-1.5 bg-white/50 backdrop-blur-sm text-gray-800 rounded-full text-sm font-medium border border-white/20">
                                {{ $university->country->name }}
                            </span>
                            <span class="px-4 py-1.5 bg-white/50 backdrop-blur-sm text-gray-800 rounded-full text-sm font-medium border border-white/20">
                                {{ $university->city }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Action Bar --}}
            @auth
            <div class="relative bg-black/20 backdrop-blur-sm px-8 py-3 flex justify-end gap-3">
                <a href="{{ route('universities.edit', $university) }}" 
                   class="px-4 py-2 bg-white/90 hover:bg-white text-gray-800 rounded-lg text-sm font-medium transition shadow-sm">
                    Edit University
                </a>
                <form action="{{ route('universities.destroy', $university) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this university?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500/90 hover:bg-red-500 text-white rounded-lg text-sm font-medium transition shadow-sm">
                        Delete
                    </button>
                </form>
            </div>
            @endauth
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                
                @if($university->about)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">About</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($university->about)) !!}
                    </div>
                </div>
                @endif

                @if($university->accommodation)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Accommodation</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($university->accommodation)) !!}
                    </div>
                </div>
                @endif

                @if($university->finance)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Finance & Tuition</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($university->finance)) !!}
                    </div>
                </div>
                @endif

                @if($university->scholarships)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Scholarships</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($university->scholarships)) !!}
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-8">

                {{-- Quick Info --}}
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">Country</dt>
                            <dd class="text-sm font-semibold text-gray-900 mt-1">{{ $university->country->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase">City</dt>
                            <dd class="text-sm font-semibold text-gray-900 mt-1">{{ $university->city }}</dd>
                        </div>
                    </dl>
                </div>
                
                @if($university->research)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Research</h3>
                    <div x-data="{ expanded: false }">
                        <div class="text-gray-600 text-sm leading-relaxed">
                            <div x-show="!expanded" x-transition>
                                {!! nl2br(e(Str::limit($university->research, 250))) !!}
                            </div>
                            <div x-show="expanded" x-transition>
                                {!! nl2br(e($university->research)) !!}
                            </div>
                        </div>
                        @if(strlen($university->research) > 250)
                            <button @click="expanded = !expanded" 
                                    class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium focus:outline-none">
                                <span x-text="expanded ? 'Show less' : 'Read more'"></span>
                            </button>
                        @endif
                    </div>
                </div>
                @endif

                @if($university->pathway)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Pathway Programs</h3>
                    <div x-data="{ expanded: false }">
                        <div class="text-gray-600 text-sm leading-relaxed">
                            <div x-show="!expanded" x-transition>
                                {!! nl2br(e(Str::limit($university->pathway, 250))) !!}
                            </div>
                            <div x-show="expanded" x-transition>
                                {!! nl2br(e($university->pathway)) !!}
                            </div>
                        </div>
                        @if(strlen($university->pathway) > 250)
                            <button @click="expanded = !expanded" 
                                    class="mt-3 text-blue-600 hover:text-blue-700 text-sm font-medium focus:outline-none">
                                <span x-text="expanded ? 'Show less' : 'Read more'"></span>
                            </button>
                        @endif
                    </div>
                </div>
                @endif

                
            </div>
        </div>

        {{-- Related Universities --}}
        @php
            $relatedUniversities = App\Models\University::where('country_id', $university->country_id)
                ->where('id', '!=', $university->id)
                ->take(4)
                ->get();
        @endphp

        @if($relatedUniversities->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">More Universities in {{ $university->country->name }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedUniversities as $relatedUni)
                <a href="{{ route('universities.show', $relatedUni->slug) }}" 
                   class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            @if($relatedUni->logo)
                                <img src="{{ asset('storage/' . $relatedUni->logo) }}" 
                                     alt="{{ $relatedUni->name }}"
                                     class="w-12 h-12 object-contain rounded-lg">
                            @else
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-600 font-bold text-lg">{{ substr($relatedUni->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                    {{ $relatedUni->name }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <span>{{ $relatedUni->city }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>