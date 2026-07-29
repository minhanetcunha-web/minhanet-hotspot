<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Novo Hotspot
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto bg-white shadow rounded-lg p-6">

            <form action="{{ route('hotspots.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block font-bold">Nome do Hotspot</label>
                    <input type="text" name="nome" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">IP</label>
                    <input type="text" name="ip" class="w-full border rounded p-2" placeholder="192.168.88.1" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Porta API</label>
                    <input type="number" name="porta" value="8728" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Usuário</label>
                    <input type="text" name="usuario" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Senha</label>
                    <input type="password" name="senha" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-bold">Observações</label>
                    <textarea name="observacoes" rows="4" class="w-full border rounded p-2"></textarea>
                </