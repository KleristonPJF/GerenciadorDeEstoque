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