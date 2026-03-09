<?php
// ==========================
// CONFIGURAÇÕES
// ==========================
$progresso = 30;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Help Desk | Em Produção</title>

    Ícone (emoji como fallback)
    <link rel="icon" href="data:,⚙️">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .card {
            background: rgba(0, 0, 0, 0.35);
            padding: 40px;
            border-radius: 16px;
            width: 420px;
            text-align: center;
            box-shadow: 0 0 40px rgba(0,0,0,.4);
        }

        .gear {
            font-size: 64px;
            margin-bottom: 20px;
            display: inline-block;
            animation: spin 2.5s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            opacity: 0.85;
            margin-bottom: 25px;
        }

        .progress-container {
            width: 100%;
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
            overflow: hidden;
            height: 18px;
        }

        .progress-bar {
            height: 100%;
            width: <?= $progresso ?>%;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            transition: width 0.6s ease;
        }

        .percent {
            margin-top: 10px;
            font-size: 13px;
            letter-spacing: 1px;
        }

        footer {
            margin-top: 25px;
            font-size: 12px;
            opacity: 0.6;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="gear">⚙️</div>

    <h1>Help Desk</h1>
    <p>Sistema em produção.<br>
       Estamos ajustando os últimos detalhes.</p>

    <div class="progress-container">
        <div class="progress-bar"></div>
    </div>

    <div class="percent">
        <?= $progresso ?>% concluído
    </div>

    <footer>
        © <?= date('Y') ?> • Suporte Técnico
    </footer>
</div>

</body>
</html> 