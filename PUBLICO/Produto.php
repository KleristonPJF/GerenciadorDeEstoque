<?php
    include '../PHP/autenticarSessao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto = $_POST['Produto'];
    $tipo = $_POST['Tipo'];
    $kg = $_POST['Kg'];
    $valor_comprado = $_POST['Valor_Comprado'];
    $porcentagem = $_POST['Porcentagem'];
    
    $valorFinal = $valor_comprado + ($valor_comprado * ($porcentagem / 100));

    try {
        $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO produto (Produto, Tipo, Kg, Valor_Comprado, Porcentagem, Valor_Vender) 
                VALUES (:produto, :tipo, :kg, :valor_comprado, :porcentagem, :valor_vender)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':kg', $kg);
        $stmt->bindParam(':valor_comprado', $valor_comprado);
        $stmt->bindParam(':porcentagem', $porcentagem);
        $stmt->bindParam(':valor_vender', $valorFinal);

        $stmt->execute();

        echo "Produto inserido com sucesso!";
    } catch (Exception $erro) {
        echo "Erro ao inserir o produto: " . $erro->getMessage();
    }
}


try {

    $conn = new PDO("mysql:host=localhost;dbname=Estoque", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $erro) {
    echo "Erro ao consultar os produtos: " . $erro->getMessage();
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
        <label for="Produto">Nome:</label>
        <input type="text" name="Produto" id="Produto">
        <br>
        <label for="Tipo">Tipo: </label>
        <select name="Tipo" id="Tipo">
            <option value="SACO">Saco</option>
            <option value="CAIXA">Caixa</option>
        </select>
        <br>
        <label for="Kg">Kg:</label>
        <input type="text" name="Kg" id="Kg">
        <br>
        <label for="Valor_Comprado">Valor comprado:</label>
        <input type="text" name="Valor_Comprado" id="Valor_Comprado">
        <br>
        <label for="Porcentagem">Porcentagem:</label>
        <input type="text" name="Porcentagem" id="Porcentagem">
        <br>
        <p id="valorFinal">Valor Final: R$ 0.00</p>
        <br>
        <button type="submit">Confirmar</button>
    </form>

    <br><br>

    <h2>Produtos Cadastrados</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Tipo</th>
                <th>Kg</th>
                <th>Valor Comprado</th>
                <th>Porcentagem</th>
                <th>Valor para Vender</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($produtos) {
                foreach ($produtos as $produto) {
                    echo "<tr>
                            <td>" . htmlspecialchars($produto['Produto']) . "</td>
                            <td>" . htmlspecialchars($produto['Tipo']) . "</td>
                            <td>" . htmlspecialchars($produto['Kg']) . "</td>
                            <td>R$ " . number_format($produto['Valor_Comprado'], 2, ',', '.') . "</td>
                            <td>" . htmlspecialchars($produto['Porcentagem']) . "%</td>
                            <td>R$ " . number_format($produto['Valor_Vender'], 2, ',', '.') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum produto encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
<script src="./JS/Produto.js"></script>
</html>
