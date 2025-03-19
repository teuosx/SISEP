<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "sisep_bd";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$curso_desejado = $_POST['curso_desejado'];
$municipio = $_POST['municipio'];
$bairro = $_POST['bairro'];

$sql = "INSERT INTO dados_pessoais (nome, data_nascimento, curso_desejado, municipio, bairro)
VALUES ('$nome', '$data_nascimento', '$curso_desejado', '$municipio', '$bairro')";

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$n_inscricao = $conn->insert_id;

$nota_portugues_sexto = $_POST['nota_portugues_sexto'];
$nota_matematica_sexto = $_POST['nota_matematica_sexto'];
$nota_historia_sexto = $_POST['nota_historia_sexto'];
$nota_geografia_sexto = $_POST['nota_geografia_sexto'];
$nota_ciencias_sexto = $_POST['nota_ciencias_sexto'];
$nota_artes_sexto = $_POST['nota_artes_sexto'];
$nota_religioso_sexto = $_POST['nota_religioso_sexto'];
$nota_ed_fisica_sexto = $_POST['nota_ed_fisica_sexto'];
$nota_ingles_sexto = $_POST['nota_ingles_sexto'];

$sql = "INSERT INTO sexto_ano (n_inscricao, nota_portugues_sexto, nota_matematica_sexto, nota_historia_sexto, nota_geografia_sexto,
nota_ciencias_sexto, nota_artes_sexto, nota_religioso_sexto, nota_ed_fisica_sexto, nota_ingles_sexto)
VALUES ('$n_inscricao', '$nota_portugues_sexto', '$nota_matematica_sexto', '$nota_historia_sexto', '$nota_geografia_sexto',
'$nota_ciencias_sexto', '$nota_artes_sexto', '$nota_religioso_sexto', '$nota_ed_fisica_sexto', '$nota_ingles_sexto')";

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$nota_portugues_setimo = $_POST['nota_portugues_setimo'];
$nota_matematica_setimo = $_POST['nota_matematica_setimo'];
$nota_historia_setimo = $_POST['nota_historia_setimo'];
$nota_geografia_setimo = $_POST['nota_geografia_setimo'];
$nota_ciencias_setimo = $_POST['nota_ciencias_setimo'];
$nota_artes_setimo = $_POST['nota_artes_setimo'];
$nota_religioso_setimo = $_POST['nota_religioso_setimo'];
$nota_ed_fisica_setimo = $_POST['nota_ed_fisica_setimo'];
$nota_ingles_setimo = $_POST['nota_ingles_setimo'];

$sql = "INSERT INTO setimo_ano (n_inscricao, nota_portugues_setimo, nota_matematica_setimo, nota_historia_setimo, nota_geografia_setimo,
nota_ciencias_setimo, nota_artes_setimo, nota_religioso_setimo, nota_ed_fisica_setimo, nota_ingles_setimo)
VALUES ('$n_inscricao', '$nota_portugues_setimo', '$nota_matematica_setimo', '$nota_historia_setimo', '$nota_geografia_setimo',
'$nota_ciencias_setimo', '$nota_artes_setimo', '$nota_religioso_setimo', '$nota_ed_fisica_setimo', '$nota_ingles_setimo')";

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$nota_portugues_oitavo = $_POST['nota_portugues_oitavo'];
$nota_matematica_oitavo = $_POST['nota_matematica_oitavo'];
$nota_historia_oitavo = $_POST['nota_historia_oitavo'];
$nota_geografia_oitavo = $_POST['nota_geografia_oitavo'];
$nota_ciencias_oitavo = $_POST['nota_ciencias_oitavo'];
$nota_artes_oitavo = $_POST['nota_artes_oitavo'];
$nota_religioso_oitavo = $_POST['nota_religioso_oitavo'];
$nota_ed_fisica_oitavo = $_POST['nota_ed_fisica_oitavo'];
$nota_ingles_oitavo = $_POST['nota_ingles_oitavo'];

$sql = "INSERT INTO oitavo_ano (n_inscricao, nota_portugues_oitavo, nota_matematica_oitavo, nota_historia_oitavo, nota_geografia_oitavo,
nota_ciencias_oitavo, nota_artes_oitavo, nota_religioso_oitavo, nota_ed_fisica_oitavo, nota_ingles_oitavo)
VALUES ('$n_inscricao', '$nota_portugues_oitavo', '$nota_matematica_oitavo', '$nota_historia_oitavo', '$nota_geografia_oitavo',
'$nota_ciencias_oitavo', '$nota_artes_oitavo', '$nota_religioso_oitavo', '$nota_ed_fisica_oitavo', '$nota_ingles_oitavo')";

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$nota_portugues_nono = $_POST['nota_portugues_nono'];
$nota_matematica_nono = $_POST['nota_matematica_nono'];
$nota_historia_nono = $_POST['nota_historia_nono'];
$nota_geografia_nono = $_POST['nota_geografia_nono'];
$nota_ciencias_nono = $_POST['nota_ciencias_nono'];
$nota_artes_nono = $_POST['nota_artes_nono'];
$nota_religioso_nono = $_POST['nota_religioso_nono'];
$nota_ed_fisica_nono = $_POST['nota_ed_fisica_nono'];
$nota_ingles_nono = $_POST['nota_ingles_nono'];

$sql = "INSERT INTO nono_ano (n_inscricao, nota_portugues_nono, nota_matematica_nono, nota_historia_nono, nota_geografia_nono,
nota_ciencias_nono, nota_artes_nono, nota_religioso_nono, nota_ed_fisica_nono, nota_ingles_nono)
VALUES ('$n_inscricao', '$nota_portugues_nono', '$nota_matematica_nono', '$nota_historia_nono', '$nota_geografia_nono',
'$nota_ciencias_nono', '$nota_artes_nono', '$nota_religioso_nono', '$nota_ed_fisica_nono', '$nota_ingles_nono')";

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$cotas = $_POST['cotas'];

$sql = "INSERT INTO cotas (n_inscricao, deficiente, escola_privada, localidade, ampla_concorrencia)
VALUES ('$n_inscricao', ";

switch ($cotas) {
    case '1':
        $sql .= "1, 0, 0, 0)";
        break;
    case '2':
        $sql .= "0, 1, 0, 0)";
        break;
    case '3':
        $sql .= "0, 0, 1, 0)";
        break;
    default:
        $sql .= "0, 0, 0, 1)";
}

if ($conn->query($sql) !== TRUE) {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

if (isset($_SESSION['admin_id'])) {
    $id_admin = $_SESSION['admin_id'];

    $sql = "SELECT tipo FROM admin WHERE id_admin = '$id_admin'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tipo_usuario = $row['tipo'];

        switch ($tipo_usuario) {
            case 'desenvolvedor':
                header("Location: guide - desenvolvedor.php");
                exit();
                break;
            case 'administrador':
                header("Location: guide - administrador.php");
                exit();
                break;
            default:
                echo "Tipo de usuário desconhecido.";
                break;
        }
    } else {
        echo "Nenhum resultado encontrado para o administrador.";
    }
} else {
    echo "ID de admin não definido na sessão.";
}

$conn->close();
?>
