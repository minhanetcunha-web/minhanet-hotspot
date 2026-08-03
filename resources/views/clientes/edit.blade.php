<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Cliente</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Editar cliente</h2>
                    <p class="mt-2 text-sm text-slate-200">Atualize os dados do cliente com um layout mais claro e elegante.</p>
                </div>
                <a href="{{ route('clientes.show', $cliente) }}" class="rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Voltar</a>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nome" class="mb-2 block text-sm font-semibold text-slate-700">Nome</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="telefone" class="mb-2 block text-sm font-semibold text-slate-700">Telefone</label>
                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="plano" class="mb-2 block text-sm font-semibold text-slate-700">Plano</label>
                    <input type="text" id="plano" name="plano" value="{{ old('plano', $cliente->plano) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select id="status" name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                        <option value="Ativo" {{ old('status', $cliente->status) === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="Bloqueado" {{ old('status', $cliente->status) === 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                        <option value="Pendente" {{ old('status', $cliente->status) === 'Pendente' ? 'selected' : '' }}>Pendente</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:-translate-y-0.5">Salvar alterações</button>
                <a href="{{ route('clientes') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
