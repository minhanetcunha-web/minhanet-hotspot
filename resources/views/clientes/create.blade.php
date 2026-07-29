<<form method="POST" action="{{ route('clientes.store') }}">
    @csrf

    <label>Nome</label><br>
    <input type="text" name="nome" placeholder="Nome do cliente" style="width:300px;"><br><br>

    <label>Telefone</label><br>
    <input type="text" name="telefone" placeholder="(00) 00000-0000" style="width:300px;"><br><br>

    <label>Plano</label><br>
    <input type="text" name="plano" placeholder="Plano contratado" style="width:300px;"><br><br>

    <button type="submit" style="background:#16a34a;color:white;padding:10px 20px;border:none;border-radius:6px;">
        Salvar Cliente
    </button>
</form>