<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('countries.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-blue-600 transition group">
                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to all countries
            </a>
        </div>

        {{-- Country Header Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="relative h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                <div class="text-center">
                    @if ($country->flag)
                        <img class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover mx-auto mb-3" 
                                src="{{ asset('storage/' . $country->flag) }}" 
                                alt="{{ $country->name }}">
                    @else
                        <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg flex items-center justify-center bg-white/20 backdrop-blur-sm mx-auto mb-3">
                            <span class="text-5xl">🏳️</span>
                        </div>
                    @endif
                    <h1 class="text-3xl font-bold text-white">{{ $country->name }}</h1>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500">ISO Code</p>
                            <p class="font-semibold text-gray-900">{{ $country->iso_code ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500">Slug</p>
                            <p class="font-mono text-sm text-gray-900">{{ $country->slug }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Universities Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Universities in {{ $country->name }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Total: {{ $country->universities->count() }} {{ Str::plural('University') }}</p>
                    </div>
                    
                    @auth
                        <a href="{{ route('universities.create', ['country_id' => $country->id]) }}" 
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add University
                        </a>
                    @endauth
                </div>
            </div>

            <div class="p-6">
                @if($country->universities->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($country->universities as $university)
                            <div class="group bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition-all duration-200 hover:border-blue-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition">
                                            {{ $university->name }}
                                        </h3>
                                        @if($university->city)
                                            <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $university->city }}
                                            </p>
                                        @endif
                                    </div>
                                    
                                    @auth
                                        <div class="flex gap-1 opacity-0 group-hover:opacity-100 transition">
                                            <a href="{{ route('universities.edit', $university) }}" 
                                               class="p-1 text-blue-400 hover:text-blue-600 transition" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('universities.destroy', $university) }}" method="POST" onsubmit="return confirm('Delete this university?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1 text-red-400 hover:text-red-600 transition" title="Delete">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endauth
                                </div>
                                
                                @if($university->description)
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ $university->description }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State for No Universities --}}
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Universities Yet</h3>
                        <p class="text-gray-500 mb-6">There are no universities added for {{ $country->name }} yet.</p>
                        @can('create', App\Models\University::class)
                            <a href="{{ route('universities.create', ['country_id' => $country->id]) }}" 
                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-5 rounded-lg transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add First University
                            </a>
                        @endcan
                            
                    </div>
                @endif
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="mt-8 flex justify-between items-center">
            <a href="{{ route('countries.index') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Countries
            </a>
            
            @can('update', $country)
                <div class="flex gap-3">
                    <a href="{{ route('countries.edit', $country) }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Country
                    </a>
                    
                    <form action="{{ route('countries.destroy', $country) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $country->name }}? This will also delete all associated universities.');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Country
                        </button>
                    </form>
                </div>
            @endcan
        </div>

    </div>
</x-app-layout>