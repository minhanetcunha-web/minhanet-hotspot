<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Planos
            </h2>

            <a href="{{ route('planos.novo') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Novo Plano
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Nome</th>
                        <th class="border p-2">Tempo</th>
                        <th class="border p-2">Preço</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($planos as $plano)
                        <tr>
                            <td class="border p-2">{{ $plano->nome }}</td>
                            <td class="border p-2">{{ $plano->tempo }} {{ $plano->unidade_tempo }}</td>
                            <td class="border p-2">{{ $plano->preco }}</td>
                            <td class="border p-2">{{ $plano->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>