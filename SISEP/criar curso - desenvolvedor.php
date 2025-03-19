<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar curso</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

    <link rel="icon" href="logo.svg" type="image/svg">
    
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            height: 100vh;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard {
            display: flex;
            width: 100%;
            height: 100%;
            background-color: white;
            overflow: hidden;
        }

        .sidebar {
            background-color: #12593f;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #f5f5dc;
            width: 288px;
            margin: 15px;
            border-radius: 16px;
        }

        .linha {
            width: 232px;
            height: auto;
            margin-top: 16px;
        }

        .logo {
            display: flex;
            align-items: flex-end;
            margin: 20px;
            margin-top: 40px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            margin-right: 10px;
        }

        .sisep {
            font-size: 40px;
            letter-spacing: 0.04em;
        }

        .menu {
            list-style: none;
            width: 100%;
            padding: 0;
            margin-top: 16px;
            margin-left: 4px;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
            cursor: pointer;
        }

        .menu-item.active,
        .menu-item:hover {
            background-color: #192841;
        }

        .menu-icon {
            width: 22px;
            height: 22px;
            margin-right: 15px;
        }

        .linha1 {
            height: auto;
            display: flex;
            margin: auto;
            justify-content: center;
            width: 232px;
        }

        .menu-i {
            width: 22px;
            height: 22px;
            margin-right: 15px;
        }

        .logout-section {
            display: flex;
            padding: 10px;
            border-radius: 8px;
            height: auto;
            margin-top: auto;
            flex-direction: column;
            width: auto;
        }

        .logout-section .botao {
            transition: background-color 0.3s ease-in-out;
            cursor: pointer;
            display: flex;
            border-radius: 8px;
            width: auto;
            padding: 10px;
            margin-left: -10px;
            margin-top: 16px;
            margin-right: -8px;
        }

        .logout-section .botao:hover {
            background-color: #192841;
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 15px;
            width: 100%;
            height: 100%;
        }

        .informacoes-pessoais {
            font-size: 32px;
            font-weight: bold;
            color: #333333;
            margin-bottom: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 720px;
        }

        input[type="text"] {
            background-color: #f0f0f0;
            border-radius: 16px;
            border: 2px solid #333333;
            height: 48px;
            margin-top: 8px;
            padding: 0 10px;
            width: calc(100% - 20px);
        }

        .botao-enviar {
            background: var(--azul-2, #0b2147);
            font-size: 16px;
            font-weight: 500;
            color: #cccccc;
            border-radius: 16px;
            width: 160px;
            height: 48px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5% auto;
        }

        .dashboard1,
        .inscrever-aluno1,
        .criar-administrador,
        .ranqueamento,
        .configuracoes,
        .logout,
        .dashboard1 {
            text-decoration: none;
            cursor: pointer;
            color: #f4f4f4;
        }
    
        
    
        .cadastro-form input[type="submit"] {
            width: 160px;
            padding: 10px;
            background-color: #192841;
            color: #f0f0f0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: "Plus Jakarta Sans", sans-serif;
            display: flex;
            align-items: center;
            margin-top: 32px;
            margin-left: 38%;
            font-size: 16px;
            margin-bottom: 16px;
        }


        .lista-cursos {
            width: 100%;
        }

        .curso-item {
            background-color: #f0f0f0;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .curso-item button {
            background-color: #F49650;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 10px;
        }

        .curso-item button.editar {
            background-color: #12593F;
        }

        .curso-item button.excluir {
            background-color: #A70F0A;
        }

    </style>
</head>

    <div class="dashboard">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.svg" alt="Sisep Logo" class="logo-icon">
                <b class="sisep">sisep</b>
            </div>
            <div class="linha0">
                <img src="linha.svg" class="linha">
            </div>
            <ul class="menu">
                <li class="menu-item">
                    <img src="dash.svg" alt="Dashboard Icon" class="menu-icon">
                    <a class="dashboard1" href="guide - desenvolvedor.php">Dashboard</a>
                </li>
                <li class="menu-item">
                    <img src="aluno.svg" alt="Inscrever Aluno Icon" class="menu-icon">
                    <a class="inscrever-aluno1" href="formulario.php">Inscrever aluno</a>
                </li>
                <li class="menu-item active">
                    <img src="livro.svg" alt="Criar curso" class="menu-icon">
                    <a class="inscrever-aluno1" href="criar curso - desenvolvedor.php">Cadastrar curso</a>
                </li>
                <li class="menu-item">
                    <img src="adm.svg" alt="Criar Administrador Icon" class="menu-icon">
                    <a class="criar-administrador" href="criar administrador - desenvolvedor.html">Criar administrador</a>
                </li>
                <li class="menu-item">
                    <img src="ranq.svg" alt="Ranqueamento Icon" class="menu-icon">
                    <a class="ranqueamento" href="ranque.php">Ranqueamento</a>
                </li>
                <li class="menu-item">
                    <img src="conf.svg" alt="Configurações Icon" class="menu-icon">
                    <a class="configuracoes" href="configuracoes - desenvolvedor.html">Configurações</a>
                </li>
            </ul>
            <div class="logout-section">
                <img src="linha.svg" class="linha1">
                <div class="botao">
                    <img src="sair.svg" alt="Logout Icon" class="menu-i">
                    <a class="logout" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="informacoes-pessoais">Administração de cursos</div>
            <div class="form-container">
                <div class="cadastro-container">
                    <form class="cadastro-form" action="inserir_curso.php" method="POST">
                        <label for="curso_nome">Nome do Curso:</label>
                        <input type="text" id="curso_nome" name="curso_nome" required maxlength="100" onkeyup="formatarNome(this)">
                        <input type="submit" value="Criar">
                    </form>
                    <div class="lista-cursos">
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "sisep_bd";
            
                        $conn = new mysqli($servername, $username, $password, $database);
            
                        if ($conn->connect_error) {
                            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                        }
            
                        $sql = "SELECT id, nome FROM cursos";
                        $result = $conn->query($sql);
            
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='curso-item'>";
                                echo "<span>ID: " . $row["id"] . " - " . $row["nome"] . "</span>";
                                echo "<form action='atualizar - curso.php' method='POST'>";
                                echo "<input type='hidden' name='curso_id' value='" . $row["id"] . "'>";
                                echo "<button class='editar'>Editar</button>";
                                echo "</form>";
                                echo "<form action='excluir_curso.php' method='POST'>";
                                echo "<input type='hidden' name='curso_id' value='" . $row["id"] . "'>";
                                echo "<button class='excluir'>Excluir</button>";
                                echo "</form>";
                                echo "</div>";
                            }
                        } else {
                            echo "Nenhum curso encontrado.";
                        }
            
                        $conn->close();
                        ?>
                    </div>
                </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('senha');
        const icon = document.getElementById('icon');

        function showHide() {
            if (password.type === 'password') {
                password.setAttribute('type', 'text');
                icon.classList.add('hide');
            } else {
                password.setAttribute('type', 'password');
                icon.classList.remove('hide');
            }
        }

        password.addEventListener('focus', () => {
            password.style.caretColor = 'transparent'; 
        });

        password.addEventListener('blur', () => {
            password.style.caretColor = '';     
        });

                    function formatarNome(campo) {
                        var nome = campo.value.toLowerCase();
                        nome = nome.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
                        campo.value = nome;
                    }
    </script>
</body>
</html>
