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
            <!-- Include Bootstrap 5 CSS for dashboard components -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Clientes cadastrados</h6>
                                    <p class="display-6 mb-0">{{ $clientesCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Clientes conectados</h6>
                                    <p class="display-6 mb-0">{{ $clientesConectados }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Usuários Radius ativos</h6>
                                    <p class="display-6 mb-0">{{ $radiusActive }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">MikroTiks cadastradas</h6>
                                    <p class="display-6 mb-0">{{ $mikrotiksCount }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Receita do dia</h6>
                                    <p class="display-6 mb-0">R$ {{ number_format($receitaDia, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Receita do mês</h6>
                                    <p class="display-6 mb-0">R$ {{ number_format($receitaMes, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Pagamentos pendentes</h6>
                                    <p class="display-6 mb-0">{{ $pagamentosPendentes }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Pagamentos aprovados</h6>
                                    <p class="display-6 mb-0">{{ $pagamentosAprovados }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Vendas - últimos 30 dias</h5>
                            <div id="sales-chart" style="height: 320px;"></div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Clientes conectados - últimos 30 dias</h5>
                            <div id="connected-chart" style="height: 240px;"></div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Últimos pagamentos</h5>
                            <div class="list-group">
                                @forelse($lastPayments as $p)
                                    <div class="list-group-item d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="fw-semibold">{{ $p->plano ?? ($p->plan ?? 'Pagamento') }}</div>
                                            <div class="text-muted small">{{ $p->created_at ?? $p->created_at ?? '' }}</div>
                                        </div>
                                        <div class="text-end">
                                            <div>R$ {{ number_format($p->valor ?? 0, 2, ',', '.') }}</div>
                                            <div class="small text-muted">{{ $p->status ?? '' }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="list-group-item">Nenhum pagamento recente.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Últimos clientes cadastrados</h5>
                            <div class="list-group">
                                @forelse($lastClientes as $c)
                                    <div class="list-group-item">
                                        <div class="fw-semibold">{{ $c->nome ?? $c->name ?? '—' }}</div>
                                        <div class="small text-muted">{{ $c->created_at ?? '' }}</div>
                                    </div>
                                @empty
                                    <div class="list-group-item">Nenhum cliente recente.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Resumo rápido</h5>
                            <p class="mb-0 text-muted">Use este painel para acompanhar vendas, conexões e pagamentos.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ApexCharts and Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

            <script>
                const salesLabels = {!! json_encode(array_values($salesLabels)) !!};
                const salesData = {!! json_encode($salesSeries) !!};

                const salesOptions = {
                    chart: { type: 'area', height: 320 },
                    series: [{ name: 'Receita', data: salesData }],
                    xaxis: { categories: salesLabels },
                    yaxis: { labels: { formatter: function (val) { return 'R$ ' + val.toFixed(2); } } },
                    tooltip: { y: { formatter: function (val) { return 'R$ ' + Number(val).toFixed(2); } } }
                };

                const salesChart = new ApexCharts(document.querySelector('#sales-chart'), salesOptions);
                salesChart.render();

                const connLabels = {!! json_encode($connLabels) !!};
                const connData = {!! json_encode($connSeries) !!};

                const connOptions = {
                    chart: { type: 'line', height: 240 },
                    series: [{ name: 'Conexões', data: connData }],
                    xaxis: { categories: connLabels }
                };

                const connChart = new ApexCharts(document.querySelector('#connected-chart'), connOptions);
                connChart.render();
            </script>
        </div>
    </div>
</x-app-layout>