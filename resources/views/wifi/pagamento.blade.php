<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento PIX</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 font-sans text-slate-800 antialiased">
    <div class="flex min-h-screen items-center justify-center bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,0.24),transparent_28%),radial-gradient(circle_at_top_right,_rgba(129,140,248,0.24),transparent_34%),linear-gradient(135deg,_#f8fbff_0%,_#eef4ff_100%)] px-4 py-6">
        <div class="w-full max-w-2xl rounded-[2rem] border border-white/70 bg-white/80 p-8 shadow-[0_30px_100px_-30px_rgba(15,23,42,0.45)] backdrop-blur-2xl">
            <div class="text-center">
                <span class="soft-pill">PIX</span>
                <h1 class="mt-4 text-3xl font-semibold text-slate-900">Pagamento Pix</h1>
                <p class="mt-2 text-sm text-slate-600">Finalize o pagamento para liberar o acesso.</p>
            </div>

            <div class="mt-8 rounded-[1.6rem] border border-slate-100 bg-slate-50/70 p-6 text-center">
                <p class="text-sm font-medium text-slate-500">Plano escolhido</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $plano }}</p>
                <p class="mt-4 text-4xl font-semibold text-cyan-700">R$ {{ number_format($valor, 2, ',', '.') }}</p>
            </div>

            @if(isset($pagamento))
                <div class="mt-8 flex flex-col items-center">
                    <div class="rounded-[1.75rem] border border-slate-100 bg-slate-50/80 p-5">
                        <img src="data:image/png;base64,{{ $pagamento->point_of_interaction->transaction_data->qr_code_base64 }}" class="mx-auto h-72 w-72 rounded-2xl object-contain" alt="QR Code Pix">
                    </div>
                    <textarea class="mt-6 min-h-[140px] w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3 text-sm text-slate-600" readonly>{{ $pagamento->point_of_interaction->transaction_data->qr_code }}</textarea>
                </div>
            @endif
        </div>
    </div>
</body>
</html>