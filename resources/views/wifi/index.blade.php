<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinhaNet Wi-Fi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-800 antialiased">
    <div class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.24),transparent_28%),radial-gradient(circle_at_top_right,_rgba(129,140,248,0.24),transparent_34%),linear-gradient(135deg,_#f8fbff_0%,_#eef4ff_100%)] px-4 py-6">
        <div class="w-full max-w-md rounded-[2rem] border border-white/70 bg-white/80 p-8 shadow-[0_30px_100px_-30px_rgba(15,23,42,0.45)] backdrop-blur-2xl">
            <div class="text-center">
                <span class="soft-pill">Wi-Fi</span>
                <h1 class="mt-4 text-3xl font-semibold text-slate-900">MinhaNet</h1>
                <p class="mt-2 text-sm text-slate-600">Escolha um plano para acessar a internet.</p>
            </div>

            <div class="mt-8 space-y-3">
                @php $planos = [['label' => '1 Hora', 'valor' => 'R$ 3,00', 'color' => 'from-cyan-500 to-cyan-600'], ['label' => '2 Horas', 'valor' => 'R$ 6,00', 'color' => 'from-indigo-500 to-indigo-600'], ['label' => '4 Horas', 'valor' => 'R$ 10,00', 'color' => 'from-amber-500 to-orange-500'], ['label' => '5 Horas', 'valor' => 'R$ 15,00', 'color' => 'from-fuchsia-500 to-purple-600']]; @endphp
                @foreach($planos as $plano)
                    <form method="POST" action="{{ route('wifi.pagar') }}">
                        @csrf
                        <input type="hidden" name="plano" value="{{ $plano['label'] }}">
                        <input type="hidden" name="valor" value="{{ str_replace(['R$ ', ',00'], ['', ''], $plano['valor']) }}">
                        <button type="submit" class="flex w-full items-center justify-between rounded-[1.2rem] bg-gradient-to-r {{ $plano['color'] }} px-5 py-4 text-left text-white shadow-lg transition hover:-translate-y-1">
                            <span class="font-semibold">{{ $plano['label'] }}</span>
                            <span class="font-semibold">{{ $plano['valor'] }}</span>
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>