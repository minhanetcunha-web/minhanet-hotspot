<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Hotspots
            </h2>

            <a href="{{ route('hotspots.novo') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Novo Hotspot
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            <table class="min-w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Nome</th>
                        <th class="border p-2">IP</th>
                        <th class="border p-2">Porta</th>
                        <th class="border p-2">Usuário</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($hotspots as $hotspot)
                        <tr>
                            <td class="border p-2">{{ $hotspot->nome }}</td>
                            <td class="border p-2">{{ $hotspot->ip }}</td>
                            <td class="border p-2">{{ $hotspot->porta }}</td>
                            <td class="border p-2">{{ $hotspot->usuario }}</td>
                            <td class="border p-2">
                                {{ $hotspot->status ? 'Ativo' : 'Inativo' }}
                            </td>
                            <td class="border p-2">
                                <a href="{{ route('hotspots.testar', $hotspot->id) }}"
                                   class="bg-blue-600 text-white px-3 py-1 rounded">
                                    Testar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border p-3 text-center">
                                Nenhum hotspot cadastrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>