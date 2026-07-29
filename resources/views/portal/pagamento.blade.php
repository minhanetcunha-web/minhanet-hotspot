<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="soft-pill">Pagamento</p>
            <h2 class="mt-2 text-2xl font-semibold text-slate-900">PIX para o seu acesso</h2>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl rounded-[2rem] border border-slate-100 bg-white/80 p-8 shadow-[0_20px_80px_-24px_rgba(15,23,42,0.25)] backdrop-blur-xl">
        <div class="text-center">
            <h3 class="text-2xl font-semibold text-slate-900">Pagamento PIX</h3>
            <p class="mt-2 text-sm text-slate-600">Escaneie o QR code abaixo para ativar seu acesso.</p>
        </div>

        @if(isset($pix))
            <div class="mt-8 flex flex-col items-center">
                <div class="rounded-[1.75rem] border border-slate-100 bg-slate-50/80 p-5">
                    <img src="data:image/png;base64,{{ $pix->point_of_interaction->transaction_data->qr_code_base64 }}" class="mx-auto h-72 w-72 rounded-2xl object-contain" alt="QR Code Pix">
                </div>
                <textarea class="mt-6 min-h-[140px] w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3 text-sm text-slate-600" readonly>{{ $pix->point_of_interaction->transaction_data->qr_code }}</textarea>
            </div>
        @else
            <div class="mt-8 rounded-2xl border border-dashed border-slate-200 bg-slate-50/70 p-8 text-center text-sm text-slate-600">
                O QR Code serÃ¡ exibido assim que o pagamento for criado.
            </div>
        @endif
    </div>
</x-app-layout>