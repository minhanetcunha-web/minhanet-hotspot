<x-app-layout>
    <x-slot name="header">
        <div class="overflow-hidden rounded-[30px] border border-slate-200/80 bg-gradient-to-br from-slate-900 via-cyan-900 to-indigo-900 p-6 text-white shadow-[0_20px_60px_-24px_rgba(15,23,42,0.45)]">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="inline-flex items-center rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Editar MikroTik</p>
                    <h2 class="mt-3 text-2xl font-semibold sm:text-3xl">Atualizar configuração</h2>
                    <p class="mt-2 text-sm text-slate-200">Altere os detalhes da MikroTik e mantenha a integração atualizada.</p>
                </div>
                <a href="{{ route('mikrotiks.index') }}" class="rounded-full border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/20">Voltar</a>
            </div>
        </div>
    </x-slot>

    <div class="rounded-[30px] border border-slate-200/80 bg-white/90 p-6 shadow-[0_25px_80px_-35px_rgba(15,23,42,0.3)] sm:p-8">
        <form action="{{ route('mikrotiks.update', $mikrotik) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label for="nome" class="mb-2 block text-sm font-semibold text-slate-700">Nome da MikroTik</label>
                    <input id="nome" name="nome" type="text" value="{{ old('nome', $mikrotik->nome) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="empresa" class="mb-2 block text-sm font-semibold text-slate-700">Empresa</label>
                    <input id="empresa" name="empresa" type="text" value="{{ old('empresa', $mikrotik->empresa) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="ip" class="mb-2 block text-sm font-semibold text-slate-700">Endereço IP</label>
                    <input id="ip" name="ip" type="text" value="{{ old('ip', $mikrotik->ip) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="porta" class="mb-2 block text-sm font-semibold text-slate-700">Porta API</label>
                    <input id="porta" name="porta" type="number" value="{{ old('porta', $mikrotik->porta) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="usuario" class="mb-2 block text-sm font-semibold text-slate-700">Usuário API</label>
                    <input id="usuario" name="usuario" type="text" value="{{ old('usuario', $mikrotik->usuario) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="senha" class="mb-2 block text-sm font-semibold text-slate-700">Senha API</label>
                    <input id="senha" name="senha" type="password" value="{{ old('senha', $mikrotik->senha) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="servidor_radius" class="mb-2 block text-sm font-semibold text-slate-700">Servidor Radius</label>
                    <input id="servidor_radius" name="servidor_radius" type="text" value="{{ old('servidor_radius', $mikrotik->servidor_radius) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">Status</label>
                    <select id="status" name="status" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                        <option value="Ativo" {{ old('status', $mikrotik->status) === 'Ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="Inativo" {{ old('status', $mikrotik->status) === 'Inativo' ? 'selected' : '' }}>Inativo</option>
                        <option value="Sincronizada" {{ old('status', $mikrotik->status) === 'Sincronizada' ? 'selected' : '' }}>Sincronizada</option>
                    </select>
                </div>
                <div>
                    <label for="chave_publica_wireguard" class="mb-2 block text-sm font-semibold text-slate-700">Chave Pública WireGuard</label>
                    <textarea id="chave_publica_wireguard" name="chave_publica_wireguard" rows="3" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">{{ old('chave_publica_wireguard', $mikrotik->chave_publica_wireguard) }}</textarea>
                </div>
                <div>
                    <label for="chave_privada_wireguard" class="mb-2 block text-sm font-semibold text-slate-700">Chave Privada WireGuard</label>
                    <textarea id="chave_privada_wireguard" name="chave_privada_wireguard" rows="3" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">{{ old('chave_privada_wireguard', $mikrotik->chave_privada_wireguard) }}</textarea>
                </div>
                <div>
                    <label for="ip_vpn" class="mb-2 block text-sm font-semibold text-slate-700">Endereço IP da VPN</label>
                    <input id="ip_vpn" name="ip_vpn" type="text" value="{{ old('ip_vpn', $mikrotik->ip_vpn) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="porta_wireguard" class="mb-2 block text-sm font-semibold text-slate-700">Porta WireGuard</label>
                    <input id="porta_wireguard" name="porta_wireguard" type="number" value="{{ old('porta_wireguard', $mikrotik->porta_wireguard) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="endpoint_vpn" class="mb-2 block text-sm font-semibold text-slate-700">Endpoint da VPN</label>
                    <input id="endpoint_vpn" name="endpoint_vpn" type="text" value="{{ old('endpoint_vpn', $mikrotik->endpoint_vpn) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="allowed_ips" class="mb-2 block text-sm font-semibold text-slate-700">Allowed IPs</label>
                    <input id="allowed_ips" name="allowed_ips" type="text" value="{{ old('allowed_ips', $mikrotik->allowed_ips) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="nome_hotspot" class="mb-2 block text-sm font-semibold text-slate-700">Nome do Hotspot</label>
                    <input id="nome_hotspot" name="nome_hotspot" type="text" value="{{ old('nome_hotspot', $mikrotik->nome_hotspot) }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-700 shadow-sm transition focus:border-cyan-500 focus:outline-none">
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <input id="api_ssl" name="api_ssl" type="checkbox" value="1" {{ old('api_ssl', $mikrotik->api_ssl) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                    <label for="api_ssl" class="text-sm font-semibold text-slate-700">Habilitar API SSL</label>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <input id="ativo" name="ativo" type="checkbox" value="1" {{ old('ativo', $mikrotik->ativo) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                    <label for="ativo" class="text-sm font-semibold text-slate-700">Ativar dispositivo</label>
                </div>
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:-translate-y-0.5">Salvar alterações</button>
                <a href="{{ route('mikrotiks.index') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
