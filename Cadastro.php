<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['Usuario'] ?? '';
    $senha = $_POST['Senha'] ?? '';

    try {
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $SenhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuario(usuario, senha) VALUES (:usuario, :senha)";
        $resp = $conn->prepare($sql);

        $resp->bindParam(':usuario', $usuario);
        $resp->bindParam(':senha', $SenhaHash);

        $resp->execute();

        header('Location: ./?success=cadastro');
        exit;
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
    <title>GenStock - Cadastro</title>
</head>
<body>
    <form action="" method="POST">
        <label for="usuario">Usuário:</label>
        <input type="text" name="Usuario" id="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="Senha" id="senha" required>
        <br>
        <button type="submit">Enviar</button>
    </form>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'cadastro'): ?>
        <p style="color: green;">Usuário cadastrado com sucesso!</p>
    <?php endif; ?>
</body>
</html>
