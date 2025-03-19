<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sisep_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['e-mail'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'] == '0' ? 'administrador' : 'desenvolvedor';

    if (!empty($nome) && !empty($email) && !empty($senha)) {
        $stmt = $conn->prepare("INSERT INTO admin (admin_nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha, $tipo);

        if ($stmt->execute()) {
            session_start();

            if (isset($_SESSION['admin_nome'])) {
                $admin_nome_logado = $_SESSION['admin_nome'];

                $query = "SELECT tipo FROM admin WHERE admin_nome = ?";
                $stmt2 = $conn->prepare($query);
                
                if (!$stmt2) {
                    die("Preparação da declaração falhou: " . $conn->error);
                }

                $stmt2->bind_param("s", $admin_nome_logado);
                $stmt2->execute();
                $result = $stmt2->get_result();

                if ($result->num_rows > 0) {
                    $admin = $result->fetch_assoc();
                    $tipo_atual = $admin['tipo'];

                    if ($tipo_atual == 'desenvolvedor') {
                        header("Location: guide - desenvolvedor.php?nome=");
                    } elseif ($tipo_atual == 'administrador') {
                        header("Location: guide - administrador.php?nome=");
                    } else {
                        echo "Tipo de usuário desconhecido.";
                    }
                    exit();
                } else {
                    echo "Nenhum resultado encontrado.";
                }

                $stmt2->close();
            } else {
                echo "Sessão não encontrada.";
            }
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
