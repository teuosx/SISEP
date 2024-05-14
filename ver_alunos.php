<?php
// Conexão com o banco de dados (substitua pelos seus dados)
$servername = "localhost";
$username = "root";
$password = "";
$database = "sisep_bd";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta SQL para recuperar os dados dos alunos
$sql = "SELECT 
            dp.nome, 
            dp.telefone, 
            dp.cpf, 
            dp.data_nascimento, 
            dp.email, 
            dp.curso_desejado, 
            dp.laudo_medico, 
            e.estado AS estado_endereco, 
            e.cidade AS cidade_endereco, 
            e.bairro AS bairro_endereco, 
            e.rua AS rua_endereco, 
            e.numero AS numero_endereco, 
            e.complemento AS complemento_endereco, 
            e.comprovante_residencia AS comprovante_residencia_endereco, 
            n.nota_sexto, 
            n.nota_setimo, 
            n.nota_oitavo, 
            n.nota_nonobim1, 
            n.nota_nonobim2, 
            n.nota_nonobim3, 
            n.nota_nonobim4,
            c.deficiente, 
            c.escola_privada, 
            c.localidade 
        FROM 
            dados_pessoais dp
        LEFT JOIN 
            endereco e ON dp.id = e.id
        LEFT JOIN 
            notas n ON dp.id = n.id
        LEFT JOIN 
            cotas c ON dp.id = c.id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Lista de Alunos Cadastrados</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Email</th>
                <th>Curso Desejado</th>
                <th>Laudo Médico</th>
                <th>Endereço</th>
                <th>Notas</th>
                <th>Cotas</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if ($result->num_rows > 0) {
                // Exibir os dados em uma tabela
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["telefone"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["data_nascimento"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["curso_desejado"] . "</td>";
                    echo "<td>" . ($row["laudo_medico"] ? "Sim" : "Não") . "</td>";
                    echo "<td>" . $row["estado_endereco"] . ", " . $row["cidade_endereco"] . ", " . $row["bairro_endereco"] . ", " . $row["rua_endereco"] . ", " . $row["numero_endereco"] . ", " . $row["complemento_endereco"] . ", " . ($row["comprovante_residencia_endereco"] ? "Sim" : "Não") . "</td>";
                    echo "<td>" . $row["nota_sexto"] . ", " . $row["nota_setimo"] . ", " . $row["nota_oitavo"] . ", " . $row["nota_nonobim1"] . ", " . $row["nota_nonobim2"] . ", " . $row["nota_nonobim3"] . ", " . $row["nota_nonobim4"] . "</td>";
                    echo "<td>" . ($row["deficiente"] ? "Deficiente" : "") . ", " . ($row["escola_privada"] ? "Escola Privada" : "") . ", " . ($row["localidade"] ? "Localidade" : "") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Nenhum aluno cadastrado.</td></tr>";
            }
        ?>
        </tbody>
    </table>
</body>
</html>
