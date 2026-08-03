<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-sky-900 to-cyan-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Usuários Radius</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Gestão automática de acessos</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-200">Usuários são criados automaticamente após a confirmação do pagamento e aparecem aqui com status em tempo real.</p>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                    <p class="text-sm text-slate-200">Usuários cadastrados</p>
                    <p class="mt-1 text-2xl font-semibold">{{ $usuarios->count() }}</p>
                </div>
            </div>

            @php
                $ativos = $usuarios->filter(fn ($usuario) => strtolower($usuario->status ?? 'ativo') === 'ativo')->count();
                $bloqueados = $usuarios->filter(fn ($usuario) => strtolower($usuario->status ?? 'ativo') === 'bloqueado')->count();
                $desconectados = $usuarios->filter(fn ($usuario) => strtolower($usuario->status ?? 'ativo') === 'desconectado')->count();
            @endphp

            <div class="mt-6 grid gap-3 md:grid-cols-3">
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Ativos</p>
                    <p class="mt-2 text-xl font-semibold">{{ $ativos }}</p>
                </div>
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Bloqueados</p>
                    <p class="mt-2 text-xl font-semibold">{{ $bloqueados }}</p>
                </div>
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Desconectados</p>
                    <p class="mt-2 text-xl font-semibold">{{ $desconectados }}</p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-4 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        @if(session('success'))
            <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-slate-50/70 p-2">
            <table id="radius-table" class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Usuário</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Plano</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Mikrotik</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Última autenticação</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Tempo restante</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Endereço IP</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">MAC Address</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        <tr class="border-t border-slate-200/70 bg-white/70 hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm font-semibold text-slate-900">{{ $usuario->usuario }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->plano ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->mikrotik ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm">
                                @php $status = strtolower($usuario->status ?? 'ativo'); @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $status === 'bloqueado' ? 'bg-rose-100 text-rose-700' : ($status === 'desconectado' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->last_auth_at ? $usuario->last_auth_at->format('d/m/Y H:i') : '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->tempo_restante ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->ip_address ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $usuario->mac_address ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <form action="{{ route('radius.disconnect', $usuario) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Desconectar</button>
                                    </form>
                                    <form action="{{ route('radius.block', $usuario) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Bloquear</button>
                                    </form>
                                    <form action="{{ route('radius.reactivate', $usuario) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Reativar</button>
                                    </form>
                                    <form action="{{ route('radius.destroy', $usuario) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja remover este usuário Radius?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700 transition hover:bg-rose-100">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-10 text-center text-sm text-slate-500">Nenhum usuário Radius cadastrado ainda. Os acessos são criados automaticamente após a confirmação do pagamento.</td>
                        </tr>
                    @endforelse
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
                $('#radius-table').DataTable({
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
