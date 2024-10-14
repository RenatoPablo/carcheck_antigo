<?php 

require '../config/config.php';

function obterIdVeiculo($pdo, $placa) {
    $sql = "SELECT id_veiculo FROM veiculos WHERE placa = :placa";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':placa' => $placa]);
    $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $veiculo['id_veiculo'];
}

function cadastrarManutencao($pdo, $time, $km, $defeito, $idVeiculo) {

    $horaFormatada = date('Y-m-d H:i:s', strtotime($time));

    $sql = "INSERT INTO manutencoes(time_saida, km, defeito, fk_id_veiculo) VALUES (:hora, :km, :defeito, :idVeiculo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':hora' => $horaFormatada,
        ':km'   => $km,
        ':defeito' => $defeito,
        ':idVeiculo' => $idVeiculo
    ]);
    return $pdo->lastInsertId();
}

function cadastrarItensManutencao($pdo, $idManutencao, $idServicoProduto, $valorUnitario, $quantidade = null) {
    
    $valorTotal = $valorUnitario * $quantidade;
    
    $sql = "INSERT INTO itens_manutencoes_servicos(fk_id_manutencao, fk_id_servico_produto, quantidade, valor_uni, valor_total) 
            VALUES (:idManutencao, :idServicoProduto, :quant, :valorUni, :valorTotal)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':idManutencao' => $idManutencao,
        ':idServicoProduto' => $idServicoProduto,
        ':quant' => $quantidade,
        ':valorUni' => $valorUnitario,
        ':valorTotal' => $valorTotal
    ]);

    return $pdo->lastInsertId();
}



?>