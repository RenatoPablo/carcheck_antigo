<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_servico_produto'];

    // Prepara a query de exclusão
    $sql = "DELETE FROM servicos_produtos WHERE id_servico_produto = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Item excluído com sucesso.";
    } else {
        echo "Erro ao excluir o item.";
    }
}
?>
