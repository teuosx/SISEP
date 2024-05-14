<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sisep_bd";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO admin (nome, email, senha) VALUES (?, ?, ?)";
        echo "SQL: " . $sql . "<br>";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Preparação da declaração falhou: " . $conn->error);
        }

        $stmt->bind_param("sss", $nome, $email, $senha);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: dashboard.html");
        } else {
            echo "Erro ao criar novo administrador: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>
