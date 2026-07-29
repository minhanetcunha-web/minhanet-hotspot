<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <p class="soft-pill">Portal pÃºblico</p>
            <h2 class="text-2xl font-semibold text-slate-900">Acesso para clientes</h2>
            <p class="text-sm text-slate-600">Escolha o tempo de navegaÃ§Ã£o com uma experiÃªncia moderna e intuitiva.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-5xl rounded-[2rem] border border-slate-100 bg-white/80 p-8 shadow-[0_20px_80px_-24px_rgba(15,23,42,0.25)] backdrop-blur-xl sm:p-10">
        <div class="grid gap-4 md:grid-cols-2">
            @php $planos = [['label' => '1 Hora', 'valor' => 'R$ 3,00', 'color' => 'from-cyan-500 to-cyan-600'], ['label' => '2 Horas', 'valor' => 'R$ 6,00', 'color' => 'from-indigo-500 to-indigo-600'], ['label' => '4 Horas', 'valor' => 'R$ 10,00', 'color' => 'from-amber-500 to-orange-500'], ['label' => '5 Horas', 'valor' => 'R$ 15,00', 'color' => 'from-fuchsia-500 to-purple-600']]; @endphp
            @foreach($planos as $plano)
                <form method="POST" action="{{ route('portal.pagar') }}" class="group">
                    @csrf
                    <input type="hidden" name="plano" value="{{ $plano['label'] }}">
                    <input type="hidden" name="valor" value="{{ str_replace(['R$ ', ',00'], ['', ''], $plano['valor']) }}">
                    <button type="submit" class="flex w-full items-center justify-between rounded-[1.4rem] bg-gradient-to-r {{ $plano['color'] }} p-6 text-left text-white shadow-lg transition hover:-translate-y-1">
                        <div>
                            <p class="text-lg font-semibold">{{ $plano['label'] }}</p>
                            <p class="mt-1 text-sm text-white/80">Acesso rÃ¡pido para internet</p>
                        </div>
                        <span class="text-xl font-semibold">{{ $plano['valor'] }}</span>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>