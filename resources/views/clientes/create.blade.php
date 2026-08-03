<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Cadastro</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Novo cliente</h2>
                    <p class="mt-2 text-sm text-slate-200">Cadastre novos clientes com uma experiência mais limpa e moderna.</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        <form method="POST" action="{{ route('clientes.store') }}" class="space-y-5">
            @csrf

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Nome</label>
                    <input type="text" name="nome" value="{{ old('nome') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="Nome do cliente" required>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">E-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="cliente@email.com">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Telefone</label>
                    <input type="text" name="telefone" value="{{ old('telefone') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="(00) 00000-0000">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Plano</label>
                    <input type="text" name="plano" value="{{ old('plano') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" placeholder="Plano contratado">
                </div>
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:-translate-y-0.5">
                    Salvar cliente
                </button>
                <a href="{{ route('clientes') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>