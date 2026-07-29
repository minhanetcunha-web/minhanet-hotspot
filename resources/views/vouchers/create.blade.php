<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Novo Voucher
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('vouchers.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Perfil</label>
                    <select name="perfil" class="w-full border rounded p-2">
                        <option value="1 Hora">1 Hora</option>
                        <option value="2 Horas">2 Horas</option>
                        <option value="4 Horas">4 Horas</option>
                        <option value="5 Horas">5 Horas</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label>Valor</label>
                    <input type="number"
                           step="0.01"
                           name="valor"
                           class="w-full border rounded p-2">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Salvar Voucher
                </button>

            </form>

        </div>
    </div>
</x-app-layout>