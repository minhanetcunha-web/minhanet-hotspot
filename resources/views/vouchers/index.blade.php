<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Vouchers
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h3 class="text-lg font-bold mb-4">Lista de Vouchers</h3>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div style="margin:20px 0;">
    <a href="{{ route('vouchers.novo') }}"
       style="background:#2563eb;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;display:inline-block;">
        + Novo Voucher
    </a>
</div>

            <table class="w-full mt-6 border">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Perfil</th>
                        <th>Valor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->codigo }}</td>
                        <td>{{ $voucher->perfil }}</td>
                        <td>R$ {{ number_format($voucher->valor,2,',','.') }}</td>
                        <td>{{ $voucher->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>