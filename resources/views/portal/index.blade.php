<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Portal Minha Net
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">

                <h1 class="text-4xl font-bold text-center text-green-600">
                    Minha Net Telecomunicações
                </h1>

                <p class="text-center text-gray-600 mt-3 mb-8">
                    Escolha quanto tempo deseja navegar.
                </p>
                <form method="POST" action="{{ route('portal.pagar') }}">
                    @csrf
                    <input type="hidden" name="plano" value="1 Hora">
                    <input type="hidden" name="valor" value="3">

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white p-5 rounded-lg mb-4 text-xl font-bold">
                        1 Hora - R$ 3,00
                    </button>
                </form>

                <form method="POST" action="{{ route('portal.pagar') }}">
                    @csrf
                    <input type="hidden" name="plano" value="2 Horas">
                    <input type="hidden" name="valor" value="6">

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white p-5 rounded-lg mb-4 text-xl font-bold">
                        2 Horas - R$ 6,00
                    </button>
                </form>
                <form method="POST" action="{{ route('portal.pagar') }}">
                    @csrf
                    <input type="hidden" name="plano" value="4 Horas">
                    <input type="hidden" name="valor" value="10">

                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white p-5 rounded-lg mb-4 text-xl font-bold">
                        4 Horas - R$ 10,00
                    </button>
                </form>

                <form method="POST" action="{{ route('portal.pagar') }}">
                    @csrf
                    <input type="hidden" name="plano" value="5 Horas">
                    <input type="hidden" name="valor" value="15">

                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white p-5 rounded-lg text-xl font-bold">
                        5 Horas - R$ 15,00
                    </button>
                </form>

            </div>
        </div>
    </div>

</x-app-layout>