<?php

    $usuario = $_POST['Usuario'];
    $senha = $_POST['Senha'];

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
		        $id_usuario = $dados['id'];
                session_start();
                $_SESSION['id_usuario'] = $id_usuario;
                echo $id_usuario; 
                header('Location: ../Portal.html');
            } else {
                header('Location: ../Login.html?erro=senha');
            }
        } else {
            header('Location: ../Login.html?erro=usuario');
        }

    } catch (Exception $erro) {
        echo "Erro: " . $erro->getMessage();
    }

?>