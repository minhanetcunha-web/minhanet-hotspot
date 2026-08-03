<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Cliente</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Detalhes do cliente</h2>
                    <p class="mt-2 text-sm text-slate-200">Resumo completo do perfil e status do cliente.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('clientes.edit', $cliente) }}" class="rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Editar</a>
                    <a href="{{ route('clientes') }}" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:-translate-y-0.5">Voltar</a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">Nome</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->nome }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">E-mail</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->email ?? '—' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">Telefone</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->telefone ?? '—' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">Plano</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->plano ?? '—' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">Status</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->status ?? 'Ativo' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4">
                <p class="text-sm font-medium text-slate-500">Data do cadastro</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->created_at ? $cliente->created_at->format('d/m/Y H:i') : '—' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-slate-50/70 p-4 md:col-span-2">
                <p class="text-sm font-medium text-slate-500">Último acesso</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ $cliente->last_access_at ? $cliente->last_access_at->format('d/m/Y H:i') : '—' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
