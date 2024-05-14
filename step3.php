<?php
    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        // Preparar e executar a inserção de dados na tabela notas
        $stmt = $conn->prepare("INSERT INTO notas (id_candidato, nota_sexto, nota_setimo, nota_oitavo, nota_nonobim1, nota_nonobim2, nota_nonobim3, nota_nonobim4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iddddddd", $id_candidato, $nota_sexto, $nota_setimo, $nota_oitavo, $nota_nonobim1, $nota_nonobim2, $nota_nonobim3, $nota_nonobim4);

        // Variáveis do formulário
        $id_candidato = 1; // Substitua isso pelo método correto de obtenção do ID do candidato
        $nota_sexto = $_POST['nota_sexto'];
        $nota_setimo = $_POST['nota_setimo'];
        $nota_oitavo = $_POST['nota_oitavo'];
        $nota_nonobim1 = $_POST['nota_nonobim1'];
        $nota_nonobim2 = $_POST['nota_nonobim2'];
        $nota_nonobim3 = $_POST['nota_nonobim3'];
        $nota_nonobim4 = $_POST['nota_nonobim4'];

        // Executar a inserção
        if ($stmt->execute()) {
            echo "Dados da etapa 3 inseridos com sucesso.";
            header("Location: step4.html");
            exit;
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }

        // Fechar a conexão e liberar recursos
        $stmt->close();
        $conn->close();
    }
?>
