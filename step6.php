<?php
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (substitua os valores conforme necessário)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sisep_bd";

    // Cria uma conexão
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Prepara os dados para inserção
    $deficiente = isset($_POST["deficiente"]) ? 1 : 0;
    $escola_privada = isset($_POST["escola_privada"]) ? 1 : 0;
    $localidade = isset($_POST["localidade"]) ? 1 : 0;

    // Insere os dados na tabela 'cotas'
    $sql = "INSERT INTO cotas (id_candidato, deficiente, escola_privada, localidade)
            VALUES ('$id_candidato', '$deficiente', '$escola_privada', '$localidade')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a dashboard
        header("Location: dashboard.html");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
    }
?>
