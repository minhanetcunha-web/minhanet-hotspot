<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="soft-pill">Cadastro</p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Novo Plano</h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 sm:p-8">
        <form method="POST" action="{{ route('planos.store') }}" class="grid gap-5 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nome do Plano</label>
                <input type="text" name="nome" value="{{ old('nome') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2 block text-sm font-semibold text-slate-700">DescriÃ§Ã£o</label>
                <textarea name="descricao" class="min-h-[120px] w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100">{{ old('descricao') }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Tempo</label>
                <input type="number" name="tempo" value="{{ old('tempo', 1) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Unidade de Tempo</label>
                <select name="unidade_tempo" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100">
                    <option value="minuto">Minutos</option>
                    <option value="hora" selected>Horas</option>
                    <option value="dia">Dias</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">PreÃ§o (R$)</label>
                <input type="number" step="0.01" name="preco" value="{{ old('preco') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Download (Mbps)</label>
                <input type="number" name="download" value="{{ old('download') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Upload (Mbps)</label>
                <input type="number" name="upload" value="{{ old('upload') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Dispositivos SimultÃ¢neos</label>
                <input type="number" name="simultaneos" value="{{ old('simultaneos', 1) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div class="md:col-span-2 flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                    Salvar Plano
                </button>
                <a href="{{ route('planos') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>