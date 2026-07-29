<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MinhaNet') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-950 font-sans text-slate-800 antialiased">
        <div class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.24),transparent_28%),radial-gradient(circle_at_top_right,_rgba(129,140,248,0.24),transparent_34%),linear-gradient(135deg,_#f8fbff_0%,_#eef4ff_100%)] px-4 py-10 sm:px-6 lg:px-8">
            <div class="w-full max-w-5xl overflow-hidden rounded-[2rem] border border-white/70 bg-white/85 shadow-[0_30px_100px_-30px_rgba(15,23,42,0.45)] backdrop-blur-2xl">
                <div class="grid lg:grid-cols-[1.05fr_0.95fr]">
                    <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-700 p-8 text-white sm:p-10 lg:p-12">
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-sm font-medium text-cyan-100">
                            <span class="h-2.5 w-2.5 rounded-full bg-cyan-300"></span>
                            MinhaNet Telecom
                        </div>
                        <h1 class="mt-6 text-3xl font-semibold sm:text-4xl">
                            GestÃ£o inteligente para sua rede Wi-Fi.
                        </h1>
                        <p class="mt-4 max-w-xl text-sm leading-7 text-slate-200 sm:text-base">
                            Gerencie clientes, planos, vouchers e pagamentos com uma experiÃªncia moderna, rÃ¡pida e segura.
                        </p>
                        <div class="mt-8 space-y-3 text-sm text-slate-200">
                            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3">
                                <span class="text-lg">âš¡</span>
                                <span>OperaÃ§Ã£o simples para equipes pequenas e grandes.</span>
                            </div>
                            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3">
                                <span class="text-lg">ðŸ”’</span>
                                <span>AutenticaÃ§Ã£o protegida com layout responsivo.</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 sm:p-10 lg:p-12">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>