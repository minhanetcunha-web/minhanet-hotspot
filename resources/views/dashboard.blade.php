<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <span class="soft-pill">Painel principal</span>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900">Bem-vindo à MinhaNet</h2>
                <p class="mt-2 max-w-2xl text-sm text-slate-600 sm:text-base">
                    Gerencie clientes, planos e acessos com uma experiência moderna e responsiva.
                </p>
            </div>
            <a href="{{ route('clientes.novo') }}" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">
                + Novo Cliente
            </a>
        </div>
    </x-slot>

    @php
        // Safe counts with fallbacks
        try {
            $clientesCount = \App\Models\Cliente::count();
        } catch (\Throwable $e) {
            $clientesCount = 0;
        }

        try {
            $mikrotiksCount = \App\Models\Hotspot::count();
        } catch (\Throwable $e) {
            $mikrotiksCount = 0;
        }

        // Clientes conectados: try common 'status' values if column exists
        $clientesConectados = 0;
        if (\Illuminate\Support\Facades\Schema::hasTable('clientes') && \Illuminate\Support\Facades\Schema::hasColumn('clientes', 'status')) {
            try {
                $clientesConectados = \App\Models\Cliente::whereIn('status', ['conectado','conectados','online','ativo','connected','online'])->count();
            } catch (\Throwable $e) {
                $clientesConectados = 0;
            }
        }

        // Usuários RADIUS ativos: try some common tables
        $radiusActive = 0;
        if (\Illuminate\Support\Facades\Schema::hasTable('radcheck')) {
            $radiusActive = \Illuminate\Support\Facades\DB::table('radcheck')->count();
        } elseif (\Illuminate\Support\Facades\Schema::hasTable('radius_users')) {
            $radiusActive = \Illuminate\Support\Facades\DB::table('radius_users')->count();
        } elseif (\Illuminate\Support\Facades\Schema::hasTable('radacct')) {
            $radiusActive = \Illuminate\Support\Facades\DB::table('radacct')->whereNull('acctstoptime')->count();
        }

        // Receita do dia / mês
        $receitaDia = 0;
        $receitaMes = 0;
        if (\Illuminate\Support\Facades\Schema::hasTable('pagamentos')) {
            try {
                $receitaDia = (float) \Illuminate\Support\Facades\DB::table('pagamentos')->whereDate('created_at', now()->toDateString())->sum('valor');
                $receitaMes = (float) \Illuminate\Support\Facades\DB::table('pagamentos')->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('valor');
            } catch (\Throwable $e) {
                $receitaDia = 0;
                $receitaMes = 0;
            }
        } else {
            try {
                $receitaDia = \App\Models\Pagamento::whereDate('created_at', now()->toDateString())->sum('valor');
                $receitaMes = \App\Models\Pagamento::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('valor');
            } catch (\Throwable $e) {
                $receitaDia = 0;
                $receitaMes = 0;
            }
        }

        // Pagamentos pendentes / aprovados
        $pagamentosPendentes = 0;
        $pagamentosAprovados = 0;
        if (\Illuminate\Support\Facades\Schema::hasTable('pagamentos')) {
            try {
                $pagamentosPendentes = \Illuminate\Support\Facades\DB::table('pagamentos')->whereIn('status', ['pendente','pending','aguardando'])->count();
                $pagamentosAprovados = \Illuminate\Support\Facades\DB::table('pagamentos')->whereIn('status', ['aprovado','approved','paid'])->count();
            } catch (\Throwable $e) {
                $pagamentosPendentes = 0;
                $pagamentosAprovados = 0;
            }
        } else {
            try {
                $pagamentosPendentes = \App\Models\Pagamento::whereIn('status', ['pendente','pending','aguardando'])->count();
                $pagamentosAprovados = \App\Models\Pagamento::whereIn('status', ['aprovado','approved','paid'])->count();
            } catch (\Throwable $e) {
                $pagamentosPendentes = 0;
                $pagamentosAprovados = 0;
            }
        }

        // Charts data: last 30 days sales
        $salesLabels = [];
        $salesData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $salesLabels[] = $date;
            $salesData[$date] = 0;
        }

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('pagamentos')) {
                $rows = \Illuminate\Support\Facades\DB::table('pagamentos')
                    ->select(\Illuminate\Support\Facades\DB::raw("DATE(created_at) as day"), \Illuminate\Support\Facades\DB::raw('SUM(valor) as total'))
                    ->where('created_at', '>=', now()->subDays(29))
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

                foreach ($rows as $r) {
                    if (array_key_exists($r->day, $salesData)) {
                        $salesData[$r->day] = (float) $r->total;
                    }
                }
            } else {
                $rows = \App\Models\Pagamento::where('created_at', '>=', now()->subDays(29))
                    ->select(\Illuminate\Support\Facades\DB::raw("DATE(created_at) as day"), \Illuminate\Support\Facades\DB::raw('SUM(valor) as total'))
                    ->groupBy('day')
                    ->get();
                foreach ($rows as $r) {
                    if (array_key_exists($r->day, $salesData)) {
                        $salesData[$r->day] = (float) $r->total;
                    }
                }
            }
        } catch (\Throwable $e) {
            // keep zeros
        }

        $salesSeries = array_values($salesData);

        // Connected clients chart: use sessions table if available
        $connLabels = [];
        $connData = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $connLabels[] = $date;
            $connData[$date] = 0;
        }
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('sessions')) {
                $rows = \Illuminate\Support\Facades\DB::table('sessions')
                    ->select(\Illuminate\Support\Facades\DB::raw("DATE(created_at) as day"), \Illuminate\Support\Facades\DB::raw('COUNT(*) as total'))
                    ->where('created_at', '>=', now()->subDays(29))
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

                foreach ($rows as $r) {
                    if (array_key_exists($r->day, $connData)) {
                        $connData[$r->day] = (int) $r->total;
                    }
                }
            }
        } catch (\Throwable $e) {
            // keep zeros
        }

        $connSeries = array_values($connData);

        // Latest items
        try {
            $lastPayments = \Illuminate\Support\Facades\Schema::hasTable('pagamentos') ? \Illuminate\Support\Facades\DB::table('pagamentos')->orderByDesc('created_at')->limit(6)->get() : \App\Models\Pagamento::orderByDesc('created_at')->limit(6)->get();
        } catch (\Throwable $e) {
            $lastPayments = collect();
        }

        try {
            $lastClientes = \Illuminate\Support\Facades\Schema::hasTable('clientes') ? \Illuminate\Support\Facades\DB::table('clientes')->orderByDesc('created_at')->limit(6)->get() : \App\Models\Cliente::orderByDesc('created_at')->limit(6)->get();
        } catch (\Throwable $e) {
            $lastClientes = collect();
        }
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 45%, #2563eb 100%);">
                <div class="card-body p-4 p-lg-5 text-white">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                        <div>
                            <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill bg-white/10 border border-white/20 mb-3">
                                <span class="fw-semibold">⚡ Visão geral em tempo real</span>
                            </div>
                            <h3 class="fw-bold mb-2">Seu negócio em um só painel</h3>
                            <p class="mb-0 text-white-50">Acompanhe clientes, receitas, pagamentos e conexões com uma experiência mais elegante e profissional.</p>
                        </div>
                        <div class="text-lg-end">
                            <div class="fw-semibold">Hoje</div>
                            <div class="display-6 fw-bold">R$ {{ number_format($receitaDia, 2, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                @php
                    $stats = [
                        ['label' => 'Clientes cadastrados', 'value' => $clientesCount, 'icon' => '👥', 'tone' => 'linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%)'],
                        ['label' => 'Clientes conectados', 'value' => $clientesConectados, 'icon' => '📶', 'tone' => 'linear-gradient(135deg, #10b981 0%, #059669 100%)'],
                        ['label' => 'Usuários Radius ativos', 'value' => $radiusActive, 'icon' => '🔐', 'tone' => 'linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%)'],
                        ['label' => 'MikroTiks cadastradas', 'value' => $mikrotiksCount, 'icon' => '🖧', 'tone' => 'linear-gradient(135deg, #f59e0b 0%, #ef4444 100%)'],
                        ['label' => 'Receita do dia', 'value' => 'R$ ' . number_format($receitaDia, 2, ',', '.'), 'icon' => '💰', 'tone' => 'linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%)'],
                        ['label' => 'Receita do mês', 'value' => 'R$ ' . number_format($receitaMes, 2, ',', '.'), 'icon' => '📈', 'tone' => 'linear-gradient(135deg, #14b8a6 0%, #0f766e 100%)'],
                        ['label' => 'Pagamentos pendentes', 'value' => $pagamentosPendentes, 'icon' => '⏳', 'tone' => 'linear-gradient(135deg, #f97316 0%, #dc2626 100%)'],
                        ['label' => 'Pagamentos aprovados', 'value' => $pagamentosAprovados, 'icon' => '✅', 'tone' => 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)'],
                    ];
                @endphp

                @foreach($stats as $stat)
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="card border-0 shadow-sm rounded-4 h-100" style="background: rgba(255,255,255,0.95);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-muted small fw-semibold">{{ $stat['label'] }}</span>
                                    <span class="d-inline-flex justify-content-center align-items-center rounded-circle text-white fw-bold" style="width: 44px; height: 44px; background: {{ $stat['tone'] }};">{{ $stat['icon'] }}</span>
                                </div>
                                <div class="display-6 fw-bold text-slate-900">{{ $stat['value'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1">Vendas dos últimos 30 dias</h5>
                                    <p class="text-muted mb-0">Receita consolidada por data</p>
                                </div>
                                <span class="badge rounded-pill bg-primary-subtle text-primary">ApexCharts</span>
                            </div>
                            <div id="sales-chart" style="height: 320px;"></div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1">Clientes conectados</h5>
                                    <p class="text-muted mb-0">Evolução dos acessos nos últimos 30 dias</p>
                                </div>
                                <span class="badge rounded-pill bg-success-subtle text-success">Monitoramento</span>
                            </div>
                            <div id="connected-chart" style="height: 240px;"></div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1">Últimos pagamentos</h5>
                                    <p class="text-muted mb-0">Status e valor mais recentes</p>
                                </div>
                                <a href="{{ route('vouchers') }}" class="btn btn-sm btn-outline-primary rounded-pill">Ver tudo</a>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse($lastPayments as $p)
                                    <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold text-slate-900">{{ $p->plano ?? ($p->plan ?? 'Pagamento') }}</div>
                                            <div class="text-muted small">{{ $p->created_at ?? '' }}</div>
                                        </div>
                                        <div class="text-end">
                                            <div class="fw-semibold text-slate-900">R$ {{ number_format($p->valor ?? 0, 2, ',', '.') }}</div>
                                            <div class="small text-muted">{{ $p->status ?? '' }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item px-0 py-3 text-muted">Nenhum pagamento recente.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <h5 class="fw-bold mb-1">Últimos clientes</h5>
                                    <p class="text-muted mb-0">Novos cadastros recentes</p>
                                </div>
                                <a href="{{ route('clientes') }}" class="btn btn-sm btn-outline-primary rounded-pill">Abrir</a>
                            </div>
                            <div class="list-group list-group-flush">
                                @forelse($lastClientes as $c)
                                    <div class="list-group-item px-0 py-3">
                                        <div class="fw-semibold text-slate-900">{{ $c->nome ?? $c->name ?? '—' }}</div>
                                        <div class="small text-muted">{{ $c->created_at ?? '' }}</div>
                                    </div>
                                @empty
                                    <div class="list-group-item px-0 py-3 text-muted">Nenhum cliente recente.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-lg-5">
                            <h5 class="fw-bold mb-3">Resumo rápido</h5>
                            <p class="text-muted mb-3">Monitore rapidamente o desempenho do seu negócio com métricas claras e atualizadas.</p>
                            <div class="d-grid gap-2">
                                <a href="{{ route('clientes') }}" class="btn btn-outline-primary rounded-pill">Gerenciar clientes</a>
                                <a href="{{ route('hotspots') }}" class="btn btn-outline-secondary rounded-pill">Gerenciar MikroTik</a>
                                <a href="{{ route('portal') }}" class="btn btn-outline-info rounded-pill">Abrir portal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                const salesLabels = {!! json_encode(array_values($salesLabels)) !!};
                const salesData = {!! json_encode($salesSeries) !!};

                const salesOptions = {
                    chart: { type: 'area', height: 320, toolbar: { show: false } },
                    series: [{ name: 'Receita', data: salesData }],
                    colors: ['#2563eb'],
                    stroke: { curve: 'smooth', width: 3 },
                    fill: { type: 'gradient', gradient: { shadeIntensity: 0.2, opacityFrom: 0.7, opacityTo: 0.1 } },
                    xaxis: { categories: salesLabels },
                    yaxis: { labels: { formatter: function (val) { return 'R$ ' + val.toFixed(2); } } },
                    tooltip: { y: { formatter: function (val) { return 'R$ ' + Number(val).toFixed(2); } } }
                };

                const salesChart = new ApexCharts(document.querySelector('#sales-chart'), salesOptions);
                salesChart.render();

                const connLabels = {!! json_encode($connLabels) !!};
                const connData = {!! json_encode($connSeries) !!};

                const connOptions = {
                    chart: { type: 'line', height: 240, toolbar: { show: false } },
                    series: [{ name: 'Conexões', data: connData }],
                    colors: ['#10b981'],
                    stroke: { width: 3, curve: 'smooth' },
                    xaxis: { categories: connLabels }
                };

                const connChart = new ApexCharts(document.querySelector('#connected-chart'), connOptions);
                connChart.render();
            </script>
        </div>
    </div>
</x-app-layout>