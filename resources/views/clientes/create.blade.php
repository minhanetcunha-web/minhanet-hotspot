<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="soft-pill">Cadastro</p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Novo Cliente</h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 sm:p-8">
        <form method="POST" action="{{ route('clientes.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Nome</label>
                <input type="text" name="nome" value="{{ old('nome') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="Nome do cliente" required>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Telefone</label>
                <input type="text" name="telefone" value="{{ old('telefone') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="(00) 00000-0000">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Plano</label>
                <input type="text" name="plano" value="{{ old('plano') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="Plano contratado">
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                    Salvar Cliente
                </button>
                <a href="{{ route('clientes') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>