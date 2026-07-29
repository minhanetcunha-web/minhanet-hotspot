@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto mt-10">

    <div class="bg-white rounded-xl shadow-lg p-8 text-center">

        <h1 class="text-3xl font-bold text-green-600">
            Pagamento PIX
        </h1>

        <p class="mt-3">
            Escaneie o QR Code abaixo para liberar seu acesso.
        </p>

        <div class="mt-8">
            <img src="data:image/png;base64,{{ $pix->point_of_interaction->transaction_data->qr_code_base64 }}"
                 class="mx-auto w-72">
        </div>

        <div class="mt-8">
            <label class="font-bold">PIX Copia e Cola</label>

            <textarea
                class="w-full border rounded p-3 mt-2"
                rows="6"
                readonly>{{ $pix->point_of_interaction->transaction_data->qr_code }}</textarea>
        </div>

        <div class="mt-8 text-gray-600">
            Após a confirmação do pagamento, sua internet será liberada automaticamente.
        </div>

    </div>

</div>

@endsection