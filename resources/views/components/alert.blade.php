@props(['type' => 'success', 'message'])

@php
    $styles = [
        'success' => 'bg-green-50 border-green-500 text-green-700',
        'danger' => 'bg-red-50 border-red-500 text-red-700',
        'warning' => 'bg-orange-50 border-orange-500 text-orange-700',
];

    $icons = [
        'success' => 'text-green-600',
        'danger' => 'text-red-600',
        'warning' => 'text-orange-600',
    ]
@endphp

<div class="mb-6 p-4  border-l-4  rounded-r-xl shadow-sm flex items-center gap-3 {{ $styles[$type] }}">
    <svg class="w-5 h-5 {{ $icons[$type] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ $message }}
</div>