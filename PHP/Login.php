<?php

    $usuario = $_POST['Usuario'];
    $senha = $_POST['Senha'];

    try{
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO Usuario(usuario, senha) VALUES (:usuario, :senha)";
        $resp = $conn->prepare($sql);

        $resp->bindParam(':usuario', $usuario);
        $resp->execute();

        $dados = $resp->fetchAll();

        if(count($dados) > 0){
           if (password_verify($senha, $dados['senha'])) {
            $id_usuario = $dados[0]['id'];
            session_start();
            $_SESSION['id_usuario'] =  $id_usuario;            
            header('Location: ../Portal.html');
           }else{
            header('Location: ../Login.html');
           }             
        }else{
            header('Location: ../Login.html');
        }


    }catch(Exception $erro){

    }

?>