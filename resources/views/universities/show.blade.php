<x-app-layout>
    {{-- Main Wrapper --}}
    <div class="min-h-screen bg-gray-50/50 pb-20">
        
        {{-- Immersive Hero Banner --}}
        <div class="relative bg-slate-900 overflow-hidden min-h-[450px] md:min-h-[500px] flex items-center">
            {{-- Background decorative glows --}}
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl -ml-20 -mb-20"></div>
            
            {{-- Hero Content Container --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10 w-full">
                {{-- Breadcrumb / Back --}}
                <div class="mb-8">
                    <a href="{{ route('universities.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-medium group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
                        </svg>
                        Back to Exploration
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    {{-- Left: Identity Branding --}}
                    <div class="lg:col-span-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                        <div class="flex-shrink-0">
                            @if($university->logo)
                                <div class="p-4 bg-white rounded-2xl shadow-xl border border-slate-100 realtive">
                                    <img src="{{ asset('storage/' . $university->logo) }}" alt="{{ $university->name }}" class="w-24 h-24 md:w-28 md:h-28 object-contain">
                                </div>
                            @else
                                <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl text-white font-bold text-4xl">
                                    {{ substr($university->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex flex-wrap gap-2 justify-center sm:justify-start items-center">
                                <span class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-md text-xs font-semibold uppercase tracking-wider border border-blue-500/20">
                                    {{ $university->country->name }}
                                </span>
                                <span class="text-slate-400 text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                    {{ $university->city }}
                                </span>
                            </div>
                            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-none">
                                {{ $university->name }}
                            </h1>
                        </div>
                    </div>

                    {{-- Right: Quick Stats Dashboard Panel --}}
                    <div class="lg:col-span-4 w-full">
                        <div class="bg-slate-800/60 backdrop-blur-md rounded-2xl border border-slate-700/50 p-6 shadow-xl grid grid-cols-2 gap-4">
                            <div class="p-4 bg-slate-900/40 rounded-xl border border-slate-700/30">
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">City</p>
                                <p class="text-base font-bold text-white mt-1 line-clamp-1">{{ $university->city }}</p>
                            </div>
                            <div class="p-4 bg-slate-900/40 rounded-xl border border-slate-700/30">
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider">Country</p>
                                <p class="text-base font-bold text-white mt-1 line-clamp-1">{{ $university->country->name }}</p>
                            </div>
                            
                            {{-- Admin Management Action Bar Contextual placement --}}
                            @can('update', $university)
                                <div class="col-span-2 pt-2 flex gap-3">
                                    <a href="{{ route('universities.edit', $university) }}" class="flex-1 text-center py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-xl text-sm font-semibold transition">
                                        Edit Details
                                    </a>
                                    <form action="{{ route('universities.destroy', $university) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this university?');" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-2.5 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white rounded-xl text-sm font-semibold border border-red-500/30 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Page Shell: Body Stream --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- Left Core Stream Content Column (8 cols wide) --}}
                <div class="lg:col-span-8 space-y-8">
                    
                    {{-- Alpine Componentized Premium Cinematic Slider --}}
                    @if($university->images && $university->images->count() > 0)
                        <div class="bg-white rounded-2xl shadow-md" x-data="{ activeSlide: 0 }">
                            <div class="relative rounded-tl-2xl rounded-tr-2xl overflow-hidden aspect-video group bg-slate-900">
                                {{-- Slide loops --}}
                                @foreach($university->images as $index => $image)
                                    <div x-show="activeSlide === {{ $index }}" 
                                         x-transition:enter="transition duration-500 ease-out"
                                         x-transition:enter-start="opacity-0 scale-105"
                                         x-transition:enter-end="opacity-100 scale-100"
                                         class="absolute inset-0 w-full h-full">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Campus space View {{ $index + 1 }}" class="w-full h-full object-cover">
                                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/60 via-transparent to-transparent p-6 pt-12">
                                            <p class="text-white font-medium drop-shadow-sm">({{ $index + 1 }}/{{ $university->images->count() }})</p>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Slider Arrows --}}
                                @if($university->images->count() > 1)
                                    <button @click="activeSlide = activeSlide === 0 ? {{ $university->images->count() - 1 }} : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/60 backdrop-blur-md text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
                                    </button>
                                    <button @click="activeSlide = activeSlide === {{ $university->images->count() - 1 }} ? 0 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/60 backdrop-blur-md text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                    </button>
                                @endif
                            </div>

                            {{-- Modern Dynamic Minimal Thumbnail Navigation Bar --}}
                            @if($university->images->count() > 1)
                                <div class="p-4 flex gap-2 overflow-x-auto no-scrollbar">
                                    @foreach($university->images as $index => $image)
                                        <button @click="activeSlide = {{ $index }}" 
                                                class="flex-shrink-0 w-32 h-20 rounded-lg overflow-hidden border-2 relative transition-all"
                                                :class="activeSlide === {{ $index }} ? 'border-blue-600 scale-95 ring-2 ring-blue-500/20' : 'border-transparent opacity-60 hover:opacity-100'">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Main Profile Content Grid Components --}}
                    <div class="space-y-6">
                        {{-- Component: About --}}
                        @if($university->about)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 hover:shadow-md transition-shadow">
                                <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                                    Institution Overview
                                </h2>
                                <div class="text-gray-600 leading-relaxed text-base space-y-4">
                                    {!! nl2br(e($university->about)) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Component: Finances / Tuition --}}
                        @if($university->finance)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 hover:shadow-md transition-shadow">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M5.25 7.5h13.5m-12 9h12m-9.75 0H18.75c.607 0 1.157-.344 1.415-.894l1.17-2.433a1.75 1.75 0 0 0-.214-1.805L19.5 9.75M10.5 13.5H12v2.25H10.5V13.5Z"/></svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-slate-900">Finance & Tuition Fees</h2>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100 text-gray-600 leading-relaxed text-sm">
                                    {!! nl2br(e($university->finance)) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Component: Accommodations --}}
                        @if($university->accommodation)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 hover:shadow-md transition-shadow">
                                <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-indigo-600 rounded-full"></span>
                                    Living & Accommodations
                                </h2>
                                <div class="text-gray-600 leading-relaxed text-base">
                                    {!! nl2br(e($university->accommodation)) !!}
                                </div>
                            </div>
                        @endif

                        {{-- Component: Accommodations --}}
                        @if($university->scholarships)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 hover:shadow-md transition-shadow">
                                <h2 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <span class="w-1 h-6 bg-green-600 rounded-full"></span>
                                    Scholarships
                                </h2>
                                <div class="text-gray-600 leading-relaxed text-base">
                                    {!! nl2br(e($university->scholarships)) !!}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Right Column Sticky Side Panels (4 cols wide) --}}
                <div class="lg:col-span-4 lg:sticky lg:top-6 space-y-6">
                    
                    {{-- Side Widget: Micro Research Breakdown --}}
                    @if($university->research)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{ expanded: false }">
                            <h3 class="text-base font-bold text-slate-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v17.792M14.25 3.104v17.792M4.5 18h15M4.5 6h15M4.5 12h15"/></svg>
                                Research Programs
                            </h3>
                            <div class="text-gray-600 text-sm leading-relaxed relative">
                                <div x-show="!expanded">
                                    {!! nl2br(e(Str::limit($university->research, 180))) !!}
                                </div>
                                <div x-show="expanded" x-transition:enter="transition duration-200">
                                    {!! nl2br(e($university->research)) !!}
                                </div>
                            </div>
                            @if(strlen($university->research) > 180)
                                <button @click="expanded = !expanded" class="mt-3 text-xs text-blue-600 hover:text-blue-700 font-semibold uppercase tracking-wider flex items-center gap-1 focus:outline-none">
                                    <span x-text="expanded ? 'Read less' : 'Read more'"></span>
                                </button>
                            @endif
                        </div>
                    @endif

                    {{-- Side Widget: Pathway Programs --}}
                    @if($university->pathway)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" x-data="{ expanded: false }">
                            <h3 class="text-base font-bold text-slate-900 mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12h19.5M2.25 9h19.5M2.25 15h19.5M2.25 18h19.5M2.25 6h19.5"/></svg>
                                Pathway Programs
                            </h3>
                            <div class="text-gray-600 text-sm leading-relaxed">
                                <div x-show="!expanded">
                                    {!! nl2br(e(Str::limit($university->pathway, 180))) !!}
                                </div>
                                <div x-show="expanded" x-transition:enter="transition duration-200">
                                    {!! nl2br(e($university->pathway)) !!}
                                </div>
                            </div>
                            @if(strlen($university->pathway) > 180)
                                <button @click="expanded = !expanded" class="mt-3 text-xs text-blue-600 hover:text-blue-700 font-semibold uppercase tracking-wider flex items-center gap-1 focus:outline-none">
                                    <span x-text="expanded ? 'Colapse description' : 'Show pathways'"></span>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Recommendations Bottom Track Grid Section --}}
            @php
                $relatedUniversities = App\Models\University::where('country_id', $university->country_id)
                    ->where('id', '!=', $university->id)
                    ->take(4)
                    ->get();
            @endphp

            @if($relatedUniversities->count() > 0)
                <div class="mt-20 border-t border-gray-200/80 pt-12">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                        <div>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">More in {{ $university->country->name }}</h2>
                            <p class="text-slate-500 text-sm mt-1">Explore alternative academic institutions within this geography.</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedUniversities as $relatedUni)
                            <a href="{{ route('universities.show', $relatedUni->slug) }}" class="group bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-4 mb-4">
                                        @if($relatedUni->logo)
                                            <div class="p-2 bg-gray-50 rounded-xl border border-gray-100 group-hover:bg-white group-hover:shadow-sm transition-all">
                                                <img src="{{ asset('storage/' . $relatedUni->logo) }}" alt="{{ $relatedUni->name }}" class="w-11 h-11 object-contain">
                                            </div>
                                        @else
                                            <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-bold text-base">
                                                {{ substr($relatedUni->name, 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div class="overflow-hidden">
                                            <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors text-sm line-clamp-2 leading-tight">
                                                {{ $relatedUni->name }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3 border-t border-gray-50 flex items-center justify-between text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                                        {{ $relatedUni->city }}, {{ $relatedUni->country->name }}
                                    </span>
                                    <span class="text-blue-500 font-medium group-hover:translate-x-1 transition-transform">→</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>