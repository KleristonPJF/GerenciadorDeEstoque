<?php

    $usuario = $_POST['Usuario'];
    $senha = $_POST['Senha'];

    try{
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $SenhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuario(usuario,senha) VALUES (:usuario, :senha)";
        $resp = $conn->prepare($sql);

        $resp->bindParam(':usuario',$usuario);
        $resp->bindParam(':senha',$SenhaHash);

        $resp->execute();  

        header('Location: ../Index.html');
    }catch(Exception $erro){
        echo $erro->getMessage();
    }



?>