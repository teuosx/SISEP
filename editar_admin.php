<?php
if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sisep_bd";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM admin WHERE id_admin = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc(); 
    } else {
        echo "Nenhum administrador encontrado com o ID fornecido.";
        exit; 
    }

    $conn->close();
} else {
    echo "ID do administrador não fornecido ou inválido.";
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: calc(100% - 20px);
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            width: calc(100% - 20px);
            margin: 10px 0;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form action="atualizar_admin.php" method="post">
        <input type="hidden" name="id" value="<?php echo $admin['id_admin']; ?>">
        <input type="text" name="name" value="<?php echo $admin['nome']; ?>" placeholder="Name" required>
        <input type="email" name="email" value="<?php echo $admin['email']; ?>" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Update">
    </form>
</body>
</html>
