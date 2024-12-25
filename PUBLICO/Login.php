<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'] ?? '';
    $senha = $_POST['Senha'] ?? '';

    try {
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, usuario, senha FROM Usuario WHERE usuario = :usuario";
        $resp = $conn->prepare($sql);

        $resp->bindParam(':usuario', $usuario);
        $resp->execute();

        $dados = $resp->fetch();

        if ($dados) {
            if (password_verify($senha, $dados['senha'])) {
                session_start();
                $_SESSION['id_usuario'] = $dados['id'];
                header('Location: ./Portal.html');
                exit;
            } else {
                header('Location: ./?erro=senha');
                exit;
            }
        } else {
            header('Location: ./?erro=usuario');
            exit;
        }
    } catch (Exception $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenStock</title>
</head>
<body>
    <form action="" method="POST">
        <label for="Usuario">Usuário:</label>
        <input type="text" name="Usuario" id="Usuario" required>
        <br>
        <label for="Senha">Senha:</label>
        <input type="password" name="Senha" id="Senha" required>
        <br>
        <button type="submit">Enviar</button>
    </form>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color: red;">
            <?php
            if ($_GET['erro'] === 'usuario') {
                echo "Usuário não encontrado.";
            } elseif ($_GET['erro'] === 'senha') {
                echo "Senha incorreta.";
            }
            ?>
        </p>
    <?php endif; ?>
</body>
</html>
