<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["curso_nome"]) && !empty($_POST["curso_nome"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "sisep_bd";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO cursos (nome) VALUES (?)");
        $stmt->bind_param("s", $curso_nome);

        $curso_nome = $_POST["curso_nome"];
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $admin_nome = $_SESSION['admin_nome'];
            $query = "SELECT tipo FROM admin WHERE admin_nome = ?";
            $stmt = $conn->prepare($query);

            if (!$stmt) {
                die("Preparação da declaração falhou: " . $conn->error);
            }

            $stmt->bind_param("s", $admin_nome);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                $tipo = $admin['tipo'];

                if ($tipo == 'desenvolvedor') {
                    header("Location: criar curso - desenvolvedor.php?nome=" . urlencode($admin_nome));
                    exit();
                } elseif ($tipo == 'administrador') {
                    header("Location: criar curso - administrador.php?nome=" . urlencode($admin_nome));
                    exit();
                } else {
                    echo "Tipo de usuário desconhecido.";
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
        } else {
            echo "Erro ao inserir curso: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "O campo Nome do Curso é obrigatório.";
    }
}
?>
