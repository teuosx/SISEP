<?php
session_start();

if (isset($_POST['id']) && isset($_SESSION['admin_id']) && $_POST['id'] == $_SESSION['admin_id']) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sisep_bd";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $name = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; 

    $sql = "UPDATE admin SET admin_nome=?, email=?, senha=? WHERE id_admin=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Preparação da declaração falhou: " . $conn->error);
    }

    $stmt->bind_param("sssi", $name, $email, $senha, $id); 
    if ($stmt->execute()) {
        $sql = "SELECT tipo FROM admin WHERE id_admin=?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Preparação da declaração falhou: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            $tipo = $admin['tipo'];

            if ($tipo == 'desenvolvedor') {
                header("Location: guide - desenvolvedor.php?nome=");
            } elseif ($tipo == 'administrador') {
                header("Location: guide - administrador.php?nome="); 
            } else {
                echo "Tipo de usuário desconhecido.";
            }
            exit();
        } else {
            echo "Erro ao recuperar o tipo do administrador.";
        }
    } else {
        echo "Erro ao atualizar administrador: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acesso não autorizado.";
}
?>
