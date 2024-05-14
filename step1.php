<?php
    // Defina as informações de conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sisep_bd";

    // Cria uma conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $database);

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepara os dados para inserção
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $cpf = $_POST["cpf"];
        $data_nascimento = $_POST["data_nascimento"];
        $email = $_POST["email"];
        $curso_desejado = $_POST["curso_desejado"];
        $laudo_medico = isset($_POST["laudo_medico"]) ? 1 : 0;

        // Prepara a consulta SQL
        $sql = "INSERT INTO dados_pessoais (nome, telefone, cpf, data_nascimento, email, curso_desejado, laudo_medico) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepara a instrução SQL
        $stmt = $conn->prepare($sql);

        // Verifica se a instrução SQL está pronta para execução
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }

        // Vincula os parâmetros da instrução SQL
        $stmt->bind_param("ssssssi", $nome, $telefone, $cpf, $data_nascimento, $email, $curso_desejado, $laudo_medico);

        // Executa a instrução SQL
        if ($stmt->execute() === TRUE) {
            // Redireciona para o próximo passo
            header("Location: step2.html");
            exit();
        } else {
            echo "Erro ao executar a consulta: " . $stmt->error;
        }

        // Fecha a instrução
        $stmt->close();
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>
