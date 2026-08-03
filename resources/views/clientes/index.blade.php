<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Clientes</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Gerenciamento de clientes</h2>
                    <p class="mt-2 max-w-2xl text-sm text-slate-200">Painel moderno para acompanhar cadastros, status e acessos com organização visual.</p>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/10 px-4 py-3 backdrop-blur">
                    <p class="text-sm text-slate-200">Clientes cadastrados</p>
                    <p class="mt-1 text-2xl font-semibold">{{ $clientes->count() }}</p>
                </div>
            </div>

            @php
                $clientesAtivos = $clientes->filter(fn ($cliente) => strtolower($cliente->status ?? 'ativo') !== 'bloqueado')->count();
                $clientesPendentes = $clientes->filter(fn ($cliente) => strtolower($cliente->status ?? 'ativo') === 'pendente')->count();
                $clientesBloqueados = $clientes->filter(fn ($cliente) => strtolower($cliente->status ?? 'ativo') === 'bloqueado')->count();
            @endphp

            <div class="mt-6 grid gap-3 md:grid-cols-3">
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Ativos</p>
                    <p class="mt-2 text-xl font-semibold">{{ $clientesAtivos }}</p>
                </div>
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Pendentes</p>
                    <p class="mt-2 text-xl font-semibold">{{ $clientesPendentes }}</p>
                </div>
                <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                    <p class="text-sm text-slate-200">Bloqueados</p>
                    <p class="mt-2 text-xl font-semibold">{{ $clientesBloqueados }}</p>
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
            <table id="clientes-table" class="min-w-full divide-y divide-slate-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Nome</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">E-mail</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Telefone</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Plano</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Cadastro</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Último acesso</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr class="border-t border-slate-200/70 bg-white/70 hover:bg-slate-50">
                            <td class="px-4 py-4 text-sm font-semibold text-slate-900">{{ $cliente->nome }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $cliente->email ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $cliente->telefone ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $cliente->plano ?? '—' }}</td>
                            <td class="px-4 py-4 text-sm">
                                @php $status = strtolower($cliente->status ?? 'ativo'); @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $status === 'bloqueado' ? 'bg-rose-100 text-rose-700' : ($status === 'pendente' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $cliente->created_at ? $cliente->created_at->format('d/m/Y H:i') : '—' }}</td>
                            <td class="px-4 py-4 text-sm text-slate-600">{{ $cliente->last_access_at ? $cliente->last_access_at->format('d/m/Y H:i') : '—' }}</td>
                            <td class="px-4 py-4 text-sm">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('clientes.show', $cliente) }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Visualizar</a>
                                    <a href="{{ route('clientes.edit', $cliente) }}" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">Editar</a>
                                    <form action="{{ route('clientes.toggle-status', $cliente) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:-translate-y-0.5 hover:border-cyan-300 hover:text-cyan-700">
                                            {{ strtolower($cliente->status ?? 'ativo') === 'bloqueado' ? 'Desbloquear' : 'Bloquear' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline-block" onsubmit="return confirm('Deseja excluir este cliente?');">
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
                $('#clientes-table').DataTable({
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