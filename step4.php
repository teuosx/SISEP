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

// Preparar e executar a inserção de dados na tabela notas_portugues
$stmt = $conn->prepare("INSERT INTO notas_portugues (id_candidato, nota_portugues_sexto, nota_portugues_setimo, nota_portugues_oitavo, nota_portugues_nonobim1, nota_portugues_nonobim2, nota_portugues_nonobim3, nota_portugues_nonobim4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiiiii", $id_candidato, $nota_portugues_sexto, $nota_portugues_setimo, $nota_portugues_oitavo, $nota_portugues_nonobim1, $nota_portugues_nonobim2, $nota_portugues_nonobim3, $nota_portugues_nonobim4);

// Variáveis do formulário
$id_candidato = 1; // Substitua pelo ID do candidato correspondente
$nota_portugues_sexto = $_POST['nota_portugues_sexto'];
$nota_portugues_setimo = $_POST['nota_portugues_setimo'];
$nota_portugues_oitavo = $_POST['nota_portugues_oitavo'];
$nota_portugues_nonobim1 = $_POST['nota_portugues_nonobim1'];
$nota_portugues_nonobim2 = $_POST['nota_portugues_nonobim2'];
$nota_portugues_nonobim3 = $_POST['nota_portugues_nonobim3'];
$nota_portugues_nonobim4 = $_POST['nota_portugues_nonobim4'];

// Executar a inserção
if ($stmt->execute()) {
    echo "Notas de Português inseridas com sucesso.";
    // Redirecionar para a próxima etapa ou para onde desejar
    header("Location: step5.html");
    exit;
} else {
    echo "Erro ao inserir notas de Português: " . $stmt->error;
}

// Fechar a conexão e liberar recursos
$stmt->close();
$conn->close();
?>
