<x-guest-layout>
    <div class="mx-auto max-w-xl p-6">
        <h1 class="text-2xl font-semibold">Pré-cadastro de Acesso</h1>
        <p class="mt-2 text-sm text-slate-600">Informe seus dados para prosseguir para a escolha de planos.</p>

        @if(session('warning'))
            <div class="mt-4 rounded-lg border border-yellow-200 bg-yellow-50 p-3 text-sm text-yellow-800">{{ session('warning') }}</div>
        @endif

        <form method="POST" action="{{ route('portal.registrar') }}" class="mt-6 space-y-4">
            @csrf

            <div>
                <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                <input id="nome" name="nome" type="text" required value="{{ old('nome') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                @error('nome') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input id="email" name="email" type="email" required value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                @error('email') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="contato" class="block text-sm font-medium text-gray-700">Contato (opcional)</label>
                <input id="contato" name="contato" type="text" value="{{ old('contato') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                @error('contato') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Prosseguir para planos</button>
            </div>
        </form>
    </div>
</x-guest-layout>