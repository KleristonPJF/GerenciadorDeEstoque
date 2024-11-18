<?php

    $produto = $_POST['Produto'];
    $tipo = $_POST['Tipo'];
    $kg = $_POST['Kg'];
    $valor_comprado = $_POST['Valor_Comprado'];
    $porcentagem = $_POST['Porcentagem'];
    $valorFinal = $valor_comprado + ($valor_comprado * ($porcentagem / 100));


    try {
        // Conexão com o banco de dados
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Preparando a instrução SQL para inserção
        $sql = "INSERT INTO produto (produto, tipo, kg, valor_comprado, porcentagem, valor_vender) 
                VALUES (:produto, :tipo, :kg, :valor_comprado, :porcentagem, :valor_vender)";
        
        // Preparando o comando
        $stmt = $conn->prepare($sql);
    
        // Associando os valores aos parâmetros
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':kg', $kg);
        $stmt->bindParam(':valor_comprado', $valor_comprado);
        $stmt->bindParam(':porcentagem', $porcentagem);
        $stmt->bindParam(':valor_vender', $valorFinal);
    
        // Executando o comando
        $stmt->execute();
    
        echo "Produto inserido com sucesso!";
    } catch (Exception $erro) {
        echo "Erro ao inserir o produto: " . $erro->getMessage();
    }

    

?>