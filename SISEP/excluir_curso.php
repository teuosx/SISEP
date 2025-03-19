<?php
session_start();

if (isset($_POST['curso_id']) && isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sisep_bd";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $curso_id = $_POST['curso_id'];

    $sql = "DELETE FROM cursos WHERE id='$curso_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Curso excluído com sucesso!";
    } else {
        echo "Erro ao excluir curso: " . $conn->error;
    }

    $sql_admin = "SELECT tipo FROM admin WHERE id_admin=?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("i", $admin_id);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows > 0) {
        $admin = $result_admin->fetch_assoc();
        $tipo = $admin['tipo'];

        if ($tipo == 'desenvolvedor') {
            header("Location: criar curso - desenvolvedor.php");
            exit();
        } elseif ($tipo == 'administrador') {
            header("Location: criar curso - administrador.php");
            exit();
        } else {
            echo "Tipo de usuário desconhecido.";
        }
    } else {
        echo "Erro ao recuperar o tipo do administrador.";
    }

    $conn->close();
} else {
    echo "Erro: Curso ID ou Admin ID não definido.";
    header("Location: login.html");
    exit;
}
?>
