<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b border-white/70 bg-white/80 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-cyan-500 to-indigo-600 shadow-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 21V10m8 11V3m-8 8h8" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900">MinhaNet</p>
                        <p class="text-xs text-slate-500">Painel operacional</p>
                    </div>
                </a>
            </div>

            <div class="hidden items-center gap-2 sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <span class="mr-2">🏠</span> Dashboard
                </x-nav-link>
                <x-nav-link :href="route('clientes')" :active="request()->routeIs('clientes*')">
                    <span class="mr-2">👥</span> Clientes
                </x-nav-link>
                <x-nav-link :href="route('radius.index')" :active="request()->routeIs('radius*')">
                    <span class="mr-2">🔐</span> Usuários Radius
                </x-nav-link>
                <x-nav-link :href="route('mikrotiks.index')" :active="request()->routeIs('mikrotiks*')">
                    <span class="mr-2">🖧</span> MikroTik
                </x-nav-link>
                <x-nav-link :href="route('portais')" :active="request()->routeIs('portais*')">
                    <span class="mr-2">🌐</span> Portais
                </x-nav-link>
                <x-nav-link :href="route('pagamentos')" :active="request()->routeIs('pagamentos*')">
                    <span class="mr-2">💳</span> Pagamentos
                </x-nav-link>
                <x-nav-link :href="route('configuracoes')" :active="request()->routeIs('configuracoes*')">
                    <span class="mr-2">⚙️</span> Configurações
                </x-nav-link>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <a href="{{ route('portal') }}" class="rounded-full border border-cyan-200 bg-cyan-50 px-3 py-2 text-sm font-medium text-cyan-700 transition hover:bg-cyan-100">
                    🌐 Portal
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-cyan-300 hover:text-slate-800">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Sair</x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="rounded-full border border-slate-200 bg-white p-2 text-slate-600 transition hover:text-slate-900">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-slate-200 bg-white/90 sm:hidden">
        <div class="space-y-1 px-4 py-3">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clientes')" :active="request()->routeIs('clientes*')">Clientes</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('radius.index')" :active="request()->routeIs('radius*')">Usuários Radius</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('mikrotiks.index')" :active="request()->routeIs('mikrotiks*')">MikroTik</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('portais')" :active="request()->routeIs('portais*')">Portais</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('pagamentos')" :active="request()->routeIs('pagamentos*')">Pagamentos</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('configuracoes')" :active="request()->routeIs('configuracoes*')">Configurações</x-responsive-nav-link>
        <x-responsive-nav-link :href="route('profile.edit')">Perfil</x-responsive-nav-link>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Sair</x-responsive-nav-link>
        </form>
        </div>
    </div>
</nav>