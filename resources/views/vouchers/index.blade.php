<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="soft-pill">Acesso temporário</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900">Vouchers</h2>
            </div>
            <a href="{{ route('vouchers.novo') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                + Novo Voucher
            </a>
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/70 px-6 py-4">
            <p class="text-sm font-medium text-slate-500">Vouchers emitidos para o portal</p>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr class="text-left text-sm font-semibold text-slate-500">
                        <th class="px-3 py-3">Código</th>
                        <th class="px-3 py-3">Perfil</th>
                        <th class="px-3 py-3">Valor</th>
                        <th class="px-3 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($vouchers as $voucher)
                        <tr class="text-sm text-slate-700">
                            <td class="px-3 py-4 font-medium text-slate-900">{{ $voucher->codigo }}</td>
                            <td class="px-3 py-4">{{ $voucher->perfil }}</td>
                            <td class="px-3 py-4">R$ {{ number_format($voucher->valor, 2, ',', '.') }}</td>
                            <td class="px-3 py-4"><span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">{{ $voucher->status }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-10 text-center text-sm text-slate-500">Nenhum voucher cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>