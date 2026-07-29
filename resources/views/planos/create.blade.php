<x-app-layout>
    <x-slot name="header">
        <h2>Cadastrar Plano</h2>
    </x-slot>

    <div class="py-6 px-6">

        <form method="POST" action="{{ route('planos.store') }}">
            @csrf

            <div class="mb-4">
                <label>Nome do Plano</label><br>
                <input type="text" name="nome" style="width:400px;">
            </div>

            <br>

            <div class="mb-4">
                <label>Descrição</label><br>
                <textarea name="descricao" style="width:400px;height:80px;"></textarea>
            </div>

            <br>

            <div class="mb-4">
                <label>Tempo</label><br>
                <input type="number" name="tempo">
            </div>

            <br>

            <div class="mb-4">
                <label>Unidade de Tempo</label><br>
                <select name="unidade_tempo">
                    <option value="minuto">Minutos</option>
                    <option value="hora" selected>Horas</option>
                    <option value="dia">Dias</option>
                </select>
            </div>

            <br>

            <div class="mb-4">
                <label>Preço (R$)</label><br>
                <input type="number" step="0.01" name="preco">
            </div>

            <br>

            <div class="mb-4">
                <label>Download (Mbps)</label><br>
                <input type="number" name="download">
            </div>

            <br>

            <div class="mb-4">
                <label>Upload (Mbps)</label><br>
                <input type="number" name="upload">
            </div>

            <br>

            <div class="mb-4">
                <label>Dispositivos Simultâneos</label><br>
                <input type="number" name="simultaneos" value="1">
            </div>

            <br>

            <button type="submit" style="background:green;color:white;padding:10px 20px;border:none;border-radius:6px;">
                Salvar Plano
            </button>

        </form>

    </div>
</x-app-layout>