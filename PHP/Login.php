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
                header('Location: ../PUBLICO/Portal.php');
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
