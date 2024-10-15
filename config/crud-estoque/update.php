<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_servico_produto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    // Prepara a query de atualização
    $sql = "UPDATE servicos_produtos 
            SET nome_servico_produto = :nome, 
                descricao = :descricao, 
                valor_servico_produto = :valor, 
                quantidade = :quantidade 
            WHERE id_servico_produto = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':quantidade', $quantidade);

    if ($stmt->execute()) {
        echo "Item atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o item.";
    }
}


?>
