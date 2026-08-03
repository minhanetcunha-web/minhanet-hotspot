<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">MikroTik</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Gerenciamento de MikroTik</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-200">Cadastre e gerencie roteadores MikroTik com integração completa ao painel, VPN WireGuard e scripts RouterOS 7.</p>
                </div>
                <a href="{{ route('mikrotiks.create') }}" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:-translate-y-0.5">Nova MikroTik</a>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-4 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        @if(session('success'))
            <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-slate-50/70 p-2">
            <table id="mikrotiks-table" class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Nome</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Empresa</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">IP</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Servidor Radius</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mikrotiks as $mikrotik)
                        <tr class="border-t border-slate-200/70 bg-white/70 hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm font-semibold text-slate-900">{{ $mikrotik->nome }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $mikrotik->empresa ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $mikrotik->ip }}</td>
                            <td class="px-4 py-4 text-sm">
                                @php $status = strtolower($mikrotik->status ?? 'ativo'); @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $status === 'sincronizada' ? 'bg-cyan-100 text-cyan-700' : ($status === 'inativo' ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $mikrotik->servidor_radius ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <form action="{{ route('mikrotiks.test-connection', $mikrotik) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Testar conexão</button>
                                    </form>
                                    <form action="{{ route('mikrotiks.sync', $mikrotik) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Sincronizar</button>
                                    </form>
                                    <a href="{{ route('mikrotiks.script', $mikrotik) }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Gerar Script</a>
                                    <a href="{{ route('mikrotiks.edit', $mikrotik) }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Editar</a>
                                    <form action="{{ route('mikrotiks.destroy', $mikrotik) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja excluir esta MikroTik?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-100">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#mikrotiks-table').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                    },
                    order: [[0, 'asc']],
                    pageLength: 10
                });
            });
        </script>
    @endpush
</x-app-layout>
