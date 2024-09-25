<?php


require '../config/config.php';



function cadastrarServico($pdo, $nomeServico, $descriServico, $valor) {
    $sql = "SELECT id_servico_produto FROM servico_produto WHERE nome_servico_produto = :nome";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':nome' => $nomeServico]);

    if ($stmtCheck->rowCount() > 0) {
        $servico = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $servico['id_servico_produto'];
    }

    $sqlInsert = "INSERT INTO servicos_produtos(nome_servico_produto, descricao, valor,  fk_id_tipo_servico) VALUES (:nome, :descr, :valor, :tipo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':nome'   => $nomeServico,
        ':descr'  => $descriServico,
        ':valor'  => $valor,
        ':tipo'   => '1'
    ]);
    return $pdo->lastInsertId();
}

?>