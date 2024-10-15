<?php
include('../config.php');

$query = isset($_GET['query']) ? '%' . $_GET['query'] . '%' : '';
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

// Preparar a consulta SQL
$sql = "SELECT *
        FROM servicos_produtos
        WHERE nome_servico_produto LIKE :query
        AND fk_id_tipo_servico = :tipo";

$stmt = $pdo->prepare($sql);


// Executar a consulta
$stmt->execute([
        ':query' => $query,
        ':tipo' => $tipo
]);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retornar o resultado em formato JSON
echo json_encode($resultado);
?>
