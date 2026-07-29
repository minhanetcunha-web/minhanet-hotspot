<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Minha Net Wi-Fi</title>

    <style>

        body{
            margin:0;
            padding:0;
            background:#f4f4f4;
            font-family:Arial, Helvetica, sans-serif;
        }

        .caixa{

            width:420px;
            margin:40px auto;
            background:#fff;
            border-radius:15px;
            padding:30px;
            box-shadow:0 0 20px rgba(0,0,0,.15);

        }

        h1{

            color:#16a34a;
            text-align:center;

        }

        p{

            text-align:center;
            color:#666;
            margin-bottom:30px;

        }

        button{

            width:100%;
            height:70px;
            border:none;
            border-radius:10px;
            font-size:24px;
            color:white;
            margin-bottom:15px;
            cursor:pointer;

        }

        .verde{background:#16a34a;}
        .azul{background:#2563eb;}
        .laranja{background:#ea580c;}
        .roxo{background:#7e22ce;}

        button:hover{

            opacity:.9;

        }

    </style>

</head>

<body>

<div class="caixa">

<h1>Minha Net</h1>

<p>Escolha um plano para acessar a internet</p>

<form method="POST" action="{{ route('wifi.pagar') }}">
@csrf
<input type="hidden" name="plano" value="1 Hora">
<input type="hidden" name="valor" value="3">

<button class="verde">
1 Hora - R$ 3,00
</button>

</form>

<form method="POST" action="{{ route('wifi.pagar') }}">
@csrf
<input type="hidden" name="plano" value="2 Horas">
<input type="hidden" name="valor" value="6">

<button class="azul">
2 Horas - R$ 6,00
</button>

</form>

<form method="POST" action="{{ route('wifi.pagar') }}">
@csrf
<input type="hidden" name="plano" value="4 Horas">
<input type="hidden" name="valor" value="10">

<button class="laranja">
4 Horas - R$ 10,00
</button>

</form>

<form method="POST" action="{{ route('wifi.pagar') }}">
@csrf
<input type="hidden" name="plano" value="5 Horas">
<input type="hidden" name="valor" value="15">

<button class="roxo">
5 Horas - R$ 15,00
</button>

</form>

</div>

</body>

</html>