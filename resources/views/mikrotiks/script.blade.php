<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Script RouterOS 7</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Script de integração da {{ $mikrotik->nome }}</h2>
                    <p class="mt-2 text-sm text-slate-200">Copie e cole este conteúdo no Terminal da MikroTik para completar a configuração da VPN e do acesso.</p>
                </div>
                <a href="{{ route('mikrotiks.index') }}" class="rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Voltar</a>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        <div class="rounded-2xl border border-slate-200 bg-slate-950 p-4">
            <pre class="overflow-x-auto whitespace-pre-wrap text-sm text-slate-100">{{ $script }}</pre>
        </div>
    </div>
</x-app-layout>
