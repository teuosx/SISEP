<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sisep_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT id_admin, admin_nome, tipo FROM admin WHERE email = ? AND senha = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Preparação da declaração falhou: " . $conn->error);
        }

        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $_SESSION['admin_id'] = $admin['id_admin'];
            $_SESSION['admin_nome'] = $admin['admin_nome'];
            if ($admin['tipo'] == 'desenvolvedor') {
                header("Location: guide - desenvolvedor.php?nome=" . urlencode($admin['admin_nome']));
            } elseif ($admin['tipo'] == 'administrador') {
                header("Location: guide - administrador.php?nome=" . urlencode($admin['admin_nome']));
            } else {
                echo "Tipo de usuário desconhecido.";
            }
            exit();
        } else {
            echo "Credenciais inválidas. Por favor, verifique seu e-mail e senha.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>