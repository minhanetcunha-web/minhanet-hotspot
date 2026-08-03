<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="soft-pill">Infraestrutura</p>
                <h2 class="mt-2 text-2xl font-semibold text-slate-900">Hotspots</h2>
            </div>
            <a href="{{ route('hotspots.novo') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                + Novo Roteador
            </a>
        </div>
    </x-slot>

    <div class="glass-card overflow-hidden">
        <div class="border-b border-slate-100 bg-slate-50/70 px-6 py-4">
            <p class="text-sm font-medium text-slate-500">Roteadores e conexões integradas</p>
        </div>
        <div class="overflow-x-auto p-6">
            <table class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr class="text-left text-sm font-semibold text-slate-500">
                        <th class="px-3 py-3">Nome</th>
                        <th class="px-3 py-3">IP</th>
                        <th class="px-3 py-3">Porta</th>
                        <th class="px-3 py-3">Usuário</th>
                        <th class="px-3 py-3">Status</th>
                        <th class="px-3 py-3">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($hotspots as $hotspot)
                        <tr class="text-sm text-slate-700">
                            <td class="px-3 py-4 font-medium text-slate-900">{{ $hotspot->nome }}</td>
                            <td class="px-3 py-4">{{ $hotspot->ip }}</td>
                            <td class="px-3 py-4">{{ $hotspot->porta }}</td>
                            <td class="px-3 py-4">{{ $hotspot->usuario }}</td>
                            <td class="px-3 py-4"><span class="rounded-full {{ $hotspot->ativo ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} px-3 py-1 text-xs font-semibold">{{ $hotspot->ativo ? 'Ativo' : 'Inativo' }}</span></td>
                            <td class="px-3 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('hotspots.testar', $hotspot->id) }}" class="rounded-full border border-cyan-200 bg-cyan-50 px-3 py-2 text-xs font-semibold text-cyan-700 transition hover:bg-cyan-100">Testar</a>
                                    <a href="{{ route('hotspots.criarPerfis', $hotspot->id) }}" class="rounded-full border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100">Perfis</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-10 text-center text-sm text-slate-500">Nenhum hotspot cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>