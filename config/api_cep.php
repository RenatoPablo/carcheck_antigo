<?php
header('Content-Typ: application/json');

//conexao
include 'config.php';

//funcao para verificar ou inserir estado
function inserirEstado($pdo, $nomeEstado) {
    $sqlCheck = "SELECT id_estado FROM estados WHERE nome_estado = :nome";
    $stmt = $pdo->prepare($sqlCheck);
    $stmt->execute([':nome' => $nomeEstado]);

    if ($stmtCheck->rowCount() > 0 ) {
        # code...
    }
}
?>