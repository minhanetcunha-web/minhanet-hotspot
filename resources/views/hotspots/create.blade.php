<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="soft-pill">Cadastro</p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Novo Roteador</h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 sm:p-8">
        <form method="POST" action="{{ route('hotspots.store') }}" class="grid gap-5 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nome do Roteador</label>
                <input type="text" name="nome" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">IP do MikroTik</label>
                <input type="text" name="ip" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Porta API</label>
                <input type="number" name="porta" value="8728" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">UsuÃ¡rio</label>
                <input type="text" name="usuario" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Senha</label>
                <input type="password" name="senha" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nome do Hotspot</label>
                <input type="text" name="nome_hotspot" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100">
            </div>

            <div class="md:col-span-2 flex items-center gap-3 rounded-2xl border border-slate-100 bg-slate-50/80 px-4 py-3">
                <input type="checkbox" name="ativo" value="1" checked class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                <label class="text-sm font-medium text-slate-700">Roteador ativo</label>
            </div>

            <div class="md:col-span-2 flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                    Salvar Roteador
                </button>
                <a href="{{ route('hotspots') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>