<x-app-layout>
    <x-slot name="header">
        <h2>Clientes</h2>
    </x-slot>

    <div class="py-6 px-6">

        <h1>Lista de Clientes</h1>

        <br>

       <a href="{{ route('clientes.novo') }}" style="background:#16a34a;color:white;padding:10px 18px;border-radius:6px;text-decoration:none;">
    + Novo Cliente
</a>

        <br><br>

        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Plano</th>
                <th>Status</th>
            </tr>

            <tr>
                <td colspan="4" align="center">
                    Nenhum cliente cadastrado.
                </td>
            </tr>
        </table>

    </div>
</x-app-layout>