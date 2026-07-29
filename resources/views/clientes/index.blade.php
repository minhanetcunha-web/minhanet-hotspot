<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="soft-pill">Base de clientes</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900">Clientes</h2>
            </div>
            <a href="{{ route('clientes.novo') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                + Novo Cliente
            </a>
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/70 px-6 py-4">
            <p class="text-sm font-medium text-slate-500">VisualizaÃ§Ã£o da base cadastrada</p>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr class="text-left text-sm font-semibold text-slate-500">
                        <th class="px-3 py-3">Nome</th>
                        <th class="px-3 py-3">Telefone</th>
                        <th class="px-3 py-3">Plano</th>
                        <th class="px-3 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $clientes = \App\Models\Cliente::latest()->get(); @endphp
                    @forelse($clientes as $cliente)
                        <tr class="text-sm text-slate-700">
                            <td class="px-3 py-4 font-medium text-slate-900">{{ $cliente->nome }}</td>
                            <td class="px-3 py-4">{{ $cliente->telefone ?? 'â€”' }}</td>
                            <td class="px-3 py-4">{{ $cliente->plano ?? 'â€”' }}</td>
                            <td class="px-3 py-4"><span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">{{ $cliente->status ?? 'Ativo' }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-10 text-center text-sm text-slate-500">Nenhum cliente cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>