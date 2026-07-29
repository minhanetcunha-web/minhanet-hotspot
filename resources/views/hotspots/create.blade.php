<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Novo Roteador MikroTik
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

            <form method="POST" action="{{ route('hotspots.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Nome do Roteador</label>
                    <input type="text" name="nome" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>IP do MikroTik</label>
                    <input type="text" name="ip" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Porta API</label>
                    <input type="number" name="porta" value="8728" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Usuário</label>
                    <input type="text" name="usuario" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Senha</label>
                    <input type="password" name="senha" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Nome do Hotspot</label>
                    <input type="text" name="nome_hotspot" class="w-full border rounded p-2">
                </div>

                <div class="mb-6">
                    <label>
                        <input type="checkbox" name="status" value="1" checked>
                        Roteador Ativo
                    </label>
                </div>

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                    Salvar Roteador
                </button>

            </form>

        </div>
    </div>

</x-app-layout>