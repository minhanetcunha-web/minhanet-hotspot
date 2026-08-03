@props(['active'])

@php
$classes = ($active ?? false)
    ? 'block rounded-2xl bg-cyan-50 px-3 py-2 text-start text-sm font-semibold text-cyan-700'
    : 'block rounded-2xl px-3 py-2 text-start text-sm font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>