<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Pagamento PIX</title>

    <style>

        body{
            font-family:Arial,Helvetica,sans-serif;
            background:#f5f5f5;
            margin:0;
            padding:40px;
        }

        .box{
            max-width:500px;
            margin:auto;
            background:#fff;
            padding:30px;
            border-radius:15px;
            text-align:center;
            box-shadow:0 0 20px rgba(0,0,0,.15);
        }

        h1{
            color:#16a34a;
        }

        .valor{
            font-size:40px;
            font-weight:bold;
            color:#16a34a;
            margin:25px 0;
        }

    </style>

</head>

<body>

<div class="box">

<h1>Pagamento PIX</h1>

<h2>{{ $plano }}</h2>

<div class="valor">

R$ {{ number_format($valor,2,',','.') }}

</div>

@if(isset($pagamento))

<hr><br>

<h3>QR Code PIX</h3>

<img width="250"
     src="data:image/png;base64,{{ $pagamento->point_of_interaction->transaction_data->qr_code_base64 }}">

<br><br>

<textarea
style="width:100%;height:120px;padding:10px;"
readonly>{{ $pagamento->point_of_interaction->transaction_data->qr_code }}</textarea>

@endif

</div>

</body>

</html>