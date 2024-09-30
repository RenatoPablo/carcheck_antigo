<?php


require '../config/config.php';



function cadastrarServico($pdo, $nomeServico, $descrServico, $valor, $idTipo) {
    $sql = "SELECT id_servico_produto FROM servicos_produtos WHERE nome_servico_produto = :nome";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':nome' => $nomeServico]);

    if ($stmtCheck->rowCount() > 0) {
        $servico = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $servico['id_servico_produto'];
    }

    $sqlInsert = "INSERT INTO servicos_produtos(nome_servico_produto, descricao, valor_servico_produto,  fk_id_tipo_servico) VALUES (:nome, :descr, :valor, :tipo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':nome'   => $nomeServico,
        ':descr'  => $descrServico,
        ':valor'  => $valor,
        ':tipo'   => $idTipo
    ]);
    return $pdo->lastInsertId();
}

function cadastrarMarca($pdo, $nomeMarca) {
    $sql = "SELECT id_marca_produto FROM marcas_servicos_produtos WHERE nome_marca_produto = :marca";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':marca' => $nomeMarca]);

    if ($stmtCheck->rowCount() > 0) {
        $marca = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $marca['id_marca'];
    }

    $sqlInsert = "INSERT INTO marcas_servicos_produtos(nome_marca_produto) VALUES (:marca)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':marca' => $nomeMarca]);
    return $pdo->lastInsertId();
}

function cadastrarProduto($pdo, $nomeProduto, $descrProduto, $valor, $idTipo, $idMarca) {
    $sql = "SELECT id_servico_produto FROM servicos_produtos WHERE nome_servico_produto = :nome";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':nome' => $nomeProduto]);

    if ($stmtCheck->rowCount() > 0) {
        $produto = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $produto['id_servico_produto'];
    }
    $sqlInsert = "INSERT INTO servicos_produtos(nome_servico_produto, descricao, valor_servico_produto, fk_id_marca_produto, fk_id_tipo_servico) VALUES (:nome, :descr, :valor, :idMarca, :idTipo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':nome' => $nomeProduto,
        ':descr' => $descrProduto,
        ':valor' => $valor,
        ':idMarca' => $idMarca,
        ':idTipo' => $idTipo
    ]);
    return $pdo->lastInsertId();
}
?>