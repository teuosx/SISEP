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

    // Preparar e executar a inserção de dados na tabela etapa2
    $stmt = $conn->prepare("INSERT INTO endereco (estado, cidade, bairro, rua, numero, complemento, comprovante_residencia) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $estado, $cidade, $bairro, $rua, $numero, $complemento, $comprovante_residencia);

    // Variáveis do formulário
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $comprovante_residencia = isset($_POST['comprovante_residencia']) ? 'Sim' : 'Não';

    // Executar a inserção
    if ($stmt->execute()) {
        echo "Dados da etapa 2 inseridos com sucesso.";
        header("Location: step3.html");
        exit;
    } else {
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    // Fechar a conexão e liberar recursos
    $stmt->close();
    $conn->close();
?>
