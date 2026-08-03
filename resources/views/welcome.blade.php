<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MinhaNet — Gestão de Wi-Fi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-800 antialiased">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.24),transparent_28%),radial-gradient(circle_at_top_right,_rgba(129,140,248,0.24),transparent_34%),linear-gradient(135deg,_#f8fbff_0%,_#eef4ff_100%)] px-4 py-6 sm:px-6 lg:px-8 lg:py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-6 rounded-[2.25rem] border border-white/70 bg-white/80 p-6 shadow-[0_30px_100px_-30px_rgba(15,23,42,0.45)] backdrop-blur-2xl sm:p-8 lg:p-10">
            <header class="flex flex-col gap-4 rounded-[1.5rem] border border-slate-100 bg-slate-50/70 p-4 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-100 px-3 py-1 text-sm font-medium text-cyan-700">
                        <span class="h-2.5 w-2.5 rounded-full bg-cyan-500"></span>
                        MinhaNet Telecom
                    </div>
                    <h1 class="mt-3 text-2xl font-semibold text-slate-900 sm:text-3xl">Mais velocidade, mais controle e mais automação.</h1>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Entrar</a>
                    <a href="{{ route('portal') }}" class="rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">Abrir portal</a>
                </div>
            </header>

            <main class="grid gap-6 lg:grid-cols-[1.15fr_0.85fr]">
                <section class="hero-ring p-6 sm:p-8">
                    <div class="inline-flex items-center rounded-full bg-white/70 px-3 py-1 text-sm font-medium text-slate-600">
                        Gestão completa para operação de Wi-Fi
                    </div>
                    <h2 class="mt-5 text-3xl font-semibold text-slate-900 sm:text-4xl">
                    Transforme a sua operação em um painel profissional.
                    </h2>
                    <p class="mt-4 max-w-2xl text-base leading-8 text-slate-600">
                        Centralize clientes, planos, vouchers e hotspots em um ambiente elegante, responsivo e preparado para crescer.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="rounded-full bg-gradient-to-r from-cyan-500 to-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-500/20 transition hover:translate-y-[-1px]">Criar conta</a>
                        <a href="{{ route('dashboard') }}" class="rounded-full border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:border-cyan-300 hover:text-cyan-700">Acessar painel</a>
                    </div>
                </section>

                <aside class="glass-card p-6 sm:p-8">
                    <p class="soft-pill">Funcionalidades</p>
                    <div class="mt-5 space-y-3 text-sm text-slate-600">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                            <p class="font-semibold text-slate-900">Clientes e planos</p>
                            <p class="mt-1">Organize sua base com foco em velocidade e clareza.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                            <p class="font-semibold text-slate-900">Hotspots e vouchers</p>
                            <p class="mt-1">Integre roteadores MikroTik e emita vouchers de forma prática.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50/80 p-4">
                            <p class="font-semibold text-slate-900">Portal público</p>
                            <p class="mt-1">Ofereça uma experiência moderna para os seus clientes.</p>
                        </div>
                    </div>
                </aside>
            </main>
        </div>
    </div>
</body>
</html>