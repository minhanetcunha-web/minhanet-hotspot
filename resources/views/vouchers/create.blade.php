<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="soft-pill">Cadastro</p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">Novo Voucher</h2>
        </div>
    </x-slot>

    <div class="glass-card p-6 sm:p-8">
        <form method="POST" action="{{ route('vouchers.store') }}" class="space-y-5">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Perfil</label>
                <select name="perfil" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100">
                    <option value="1 Hora">1 Hora</option>
                    <option value="2 Horas">2 Horas</option>
                    <option value="4 Horas">4 Horas</option>
                    <option value="5 Horas">5 Horas</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Valor</label>
                <input type="number" step="0.01" name="valor" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-100" required>
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                    Salvar Voucher
                </button>
                <a href="{{ route('vouchers') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">
                    Voltar
                </a>
            </div>
        </form>
    </div>
</x-app-layout>