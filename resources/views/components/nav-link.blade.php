@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center rounded-full bg-cyan-50 px-4 py-2 text-sm font-semibold text-cyan-700 shadow-sm transition duration-150 ease-in-out'
    : 'inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-slate-600 transition duration-150 ease-in-out hover:bg-slate-100 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>