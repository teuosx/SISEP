<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sisep_bd";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql = "SELECT YEAR(ano_inscricao) as ano, COUNT(*) as quantidade FROM dados_pessoais GROUP BY ano";
$result = $conn->query($sql);


$anos = [];
$quantidades = [];


if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $anos[] = (int)$row['ano'];
        $quantidades[] = (int)$row['quantidade'];
    }
} else {
    echo "0 resultados";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sisep Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" />
    <link rel="icon" href="logo.svg" type="image/svg">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .dashboard {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .sidebar {
            background-color: #12593f;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #f5f5dc;
            margin: 15px;
            border-radius: 16px;
            width: 288px;
            height: auto;
        }

        .linha{
            width: 232px;
            height: auto;
            margin-top: 16px;
        }

        .logo {
            display: flex;
            align-items: flex-end;
            margin: 20px;
            margin-top: 40px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            margin-right: 10px;
        }

        .sisep {
            font-size: 40px;
            letter-spacing: 0.04em;
        }

        .menu {
            list-style: none;
            width: 100%;
            padding: 0;
            margin-top: 16px;
            margin-left: 4px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
            cursor: pointer;
        }

        .menu-item.active, .menu-item:hover {
            background-color: #192841;
        }

        .menu-icon {
            width: 22px;
            height: 22px;
            margin-right: 15px;
        }

        .menu-iconn {
            width: 20px;
            height: 20px;
            margin-right: 15px;
        }

        .linha1{
            height: auto;
            display: flex;
            margin: auto;
            justify-content: center;
            width: 232px;
        }

        .menu-i{
            width: 22px;
            height: 22px;
            margin-right: 15px;
        }

        .logout-section {
            display: flex;
            padding: 10px;
            border-radius: 8px;
            height: auto;
            margin-top: auto;
            flex-direction: column;
            width: auto;
        }

        .logout-section .botao{
            transition: background-color 0.3s ease-in-out;
            cursor: pointer;
            display: flex;
            border-radius: 8px;
            width: auto;
            padding: 10px;
            margin-left: -10px;
            margin-top: 16px;
            margin-right: -8px;
        }

        .logout-section .botao:hover{
            background-color: #192841;
        }

        .content {
            flex-grow: 1;
            padding: 1%;
            display: flex;
            flex-direction: column;
            overflow: auto;
            box-sizing: border-box;
        }

        .header {
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .grafico {
            background-color: #ccc;
            width: 100%;
            height: 100%;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .inscrever-aluno1,
        .criar-administrador,
        .ranqueamento,
        .configuracoes,
        .logout,
        .dashboard1 {
            text-decoration: none;
            cursor: pointer;
            color: #f4f4f4;
        }

    </style>

<div class="dashboard">
    <div class="sidebar">
        <div class="logo">
            <img src="logo.svg" alt="Sisep Logo" class="logo-icon">
            <b class="sisep">sisep</b>
        </div>
        <div class="linha0">
            <img src="linha.svg" class="linha">
        </div>
        <ul class="menu">
            <li class="menu-item active">
                <img src="dash.svg" alt="Dashboard Icon" class="menu-icon">
                <a class="dashboard1" href="guide - administrador.php">Dashboard</a>
            </li>
            <li class="menu-item">
                <img src="aluno.svg" alt="Inscrever Aluno Icon" class="menu-icon">
                <a class="inscrever-aluno1" href="formulario.php">Inscrever aluno</a>
            </li>
            <li class="menu-item">
                <img src="livro.svg" alt="Criar curso" class="menu-icon">
                <a class="inscrever-aluno1" href="criar curso - administrador.php">Cadastrar curso</a>
            </li>
            <li class="menu-item">
                <img src="ranq.svg" alt="Ranqueamento Icon" class="menu-icon">
                <a class="ranqueamento" href="ranque.php">Ranqueamento</a>
            </li>
            <li class="menu-item">
                <img src="conf.svg" alt="Configurações Icon" class="menu-icon">
                <a class="configuracoes" href="configuracoes - administrador.html">Configurações</a>
            </li>
        </ul>
        <div class="logout-section">
            <img src="linha.svg" class="linha1">
            <div class="botao">
                <img src="sair.svg" alt="Logout Icon" class="menu-i">
                <a class="logout" href="login.html">Logout</a>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="main-content">
            <div class="grafico">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>

    const labels = <?php echo json_encode($anos); ?>;
    const data = <?php echo json_encode($quantidades); ?>;

    console.log(labels, data); 

    const ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantidade de Alunos Inscritos',
                data: data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>


</body>
</html>
