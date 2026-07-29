<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800">
                Roteadores MikroTik
            </h2>

            <a href="{{ route('hotspots.novo') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                + Novo Roteador
            </a>
        </div>
    </x-slot>

    <div class="p-6">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">

            <table class="min-w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Nome</th>
                        <th class="px-4 py-3 text-left">IP</th>
                        <th class="px-4 py-3 text-left">Porta</th>
                        <th class="px-4 py-3 text-left">Usuário</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Ações</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($hotspots as $hotspot)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-4 py-3">{{ $hotspot->nome }}</td>

                        <td class="px-4 py-3">
                            {{ $hotspot->ip }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $hotspot->porta }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $hotspot->usuario }}
                        </td>

                        <td class="px-4 py-3 text-center">

                            @if($hotspot->status)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Ativo
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Inativo
                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-3">

                            <div class="flex gap-2 justify-center">

                                <a href="{{ route('hotspots.testar',$hotspot->id) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">
                                    🔗 Testar
                                </a>

                                <a href="{{ route('hotspots.criarPerfis',$hotspot->id) }}"
                                   class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">
                                    ⚙ Criar Perfis
                                </a>

                                <button
                                    class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded">
                                    🎫 Vouchers
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center py-6">
                            Nenhum MikroTik cadastrado.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>