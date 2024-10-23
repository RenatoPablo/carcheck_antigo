<?php
// Conexão com o banco de dados
require '../config.php';

try {
    $sql = "SELECT * FROM formas_pagamento";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obter todos os resultados como array associativo
    $formas_pagamento = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os dados como JSON
    echo json_encode($formas_pagamento);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao buscar formas de pagamento: ' . $e->getMessage()]);
}
?>
