<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <span class="soft-pill">Painel principal</span>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900">Bem-vindo à MinhaNet</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-600 sm:text-base">
                    Gerencie clientes, planos e acessos com uma experiência mais moderna e organizada.
                </p>
            </div>
            <a href="{{ route('clientes.novo') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                + Novo Cliente
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <section class="glass-card p-6 sm:p-8">
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                @php
                    $clientes = \App\Models\Cliente::count();
                    $planos = \App\Models\Plano::count();
                    $hotspots = \App\Models\Hotspot::count();
                    $vouchers = \App\Models\Voucher::count();
                @endphp

                @foreach([
                    ['label' => 'Clientes', 'value' => $clientes, 'icon' => '👥', 'tone' => 'from-cyan-500 to-cyan-600'],
                    ['label' => 'Planos', 'value' => $planos, 'icon' => '📶', 'tone' => 'from-indigo-500 to-indigo-600'],
                    ['label' => 'Hotspots', 'value' => $hotspots, 'icon' => '📡', 'tone' => 'from-fuchsia-500 to-fuchsia-600'],
                    ['label' => 'Vouchers', 'value' => $vouchers, 'icon' => '🎫', 'tone' => 'from-emerald-500 to-emerald-600'],
                ] as $stat)
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-5">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-slate-500">{{ $stat['label'] }}</p>
                            <span class="text-2xl">{{ $stat['icon'] }}</span>
                        </div>
                        <div class="mt-4 flex items-end justify-between">
                            <p class="text-3xl font-semibold text-slate-900">{{ $stat['value'] }}</p>
                            <span class="rounded-full bg-gradient-to-r {{ $stat['tone'] }} px-2.5 py-1 text-xs font-semibold text-white">Live</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <div class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="glass-card p-6 sm:p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="soft-pill">Atalhos</p>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900">O que você pode fazer agora</h3>
                    </div>
                </div>

                <div class="mt-6 grid gap-3 sm:grid-cols-2">
                    <a href="{{ route('clientes') }}" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-cyan-200 hover:bg-white">
                        <p class="text-lg font-semibold text-slate-900">Gerenciar clientes</p>
                        <p class="mt-1 text-sm text-slate-600">Cadastre e acompanhe contatos e planos.</p>
                    </a>
                    <a href="{{ route('planos') }}" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-cyan-200 hover:bg-white">
                        <p class="text-lg font-semibold text-slate-900">Criar planos</p>
                        <p class="mt-1 text-sm text-slate-600">Estruture velocidades, tempo e disponibilidade.</p>
                    </a>
                    <a href="{{ route('hotspots') }}" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-cyan-200 hover:bg-white">
                        <p class="text-lg font-semibold text-slate-900">Conectar hotspots</p>
                        <p class="mt-1 text-sm text-slate-600">Teste e configure roteadores MikroTik.</p>
                    </a>
                    <a href="{{ route('vouchers') }}" class="rounded-2xl border border-slate-100 bg-slate-50/70 p-4 transition hover:border-cyan-200 hover:bg-white">
                        <p class="text-lg font-semibold text-slate-900">Liberar vouchers</p>
                        <p class="mt-1 text-sm text-slate-600">Ative perfis com rapidez para seus clientes.</p>
                    </a>
                </div>
            </section>

            <section class="glass-card p-6 sm:p-8">
                <p class="soft-pill">Resumo operacional</p>
                <div class="mt-6 space-y-4">
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <p class="text-sm font-medium text-slate-500">Status do portal</p>
                        <p class="mt-2 text-xl font-semibold text-slate-900">Em funcionamento</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <p class="text-sm font-medium text-slate-500">Próximo passo</p>
                        <p class="mt-2 text-xl font-semibold text-slate-900">Adicione novos planos e vouchers.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                        <p class="text-sm font-medium text-slate-500">Experiência</p>
                        <p class="mt-2 text-xl font-semibold text-slate-900">Interface moderna e responsiva.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>