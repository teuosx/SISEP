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

// Preparar e executar a inserção de dados na tabela notas_matematica
$stmt = $conn->prepare("INSERT INTO notas_matematica (id_candidato, nota_matematica_sexto, nota_matematica_setimo, nota_matematica_oitavo, nota_matematica_nonobim1, nota_matematica_nonobim2, nota_matematica_nonobim3, nota_matematica_nonobim4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiiiii", $id_candidato, $nota_matematica_sexto, $nota_matematica_setimo, $nota_matematica_oitavo, $nota_matematica_nonobim1, $nota_matematica_nonobim2, $nota_matematica_nonobim3, $nota_matematica_nonobim4);

// Variáveis do formulário
$id_candidato = 1; // Substitua pelo ID do candidato correspondente
$nota_matematica_sexto = $_POST['nota_matematica_sexto'];
$nota_matematica_setimo = $_POST['nota_matematica_setimo'];
$nota_matematica_oitavo = $_POST['nota_matematica_oitavo'];
$nota_matematica_nonobim1 = $_POST['nota_matematica_nonobim1'];
$nota_matematica_nonobim2 = $_POST['nota_matematica_nonobim2'];
$nota_matematica_nonobim3 = $_POST['nota_matematica_nonobim3'];
$nota_matematica_nonobim4 = $_POST['nota_matematica_nonobim4'];

// Executar a inserção
if ($stmt->execute()) {
    echo "Notas de Matemática inseridas com sucesso.";
    // Redirecionar para a próxima etapa ou para onde desejar
    header("Location: step6.html");
    exit;
} else {
    echo "Erro ao inserir notas de Matemática: " . $stmt->error;
}

// Fechar a conexão e liberar recursos
$stmt->close();
$conn->close();
?>
