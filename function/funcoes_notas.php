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

function atualizarEstoqueProduto($pdo, $idProduto, $quantidadeUtilizada) {
    // Consulta para obter a quantidade atual do estoque
    $sql = "SELECT quantidade FROM servicos_produtos WHERE id_servico_produto = :idProduto";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':idProduto' => $idProduto]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($produto && isset($produto['quantidade'])) {
        // Calcula o novo valor de estoque
        $novaQuantidade = $produto['quantidade'] - $quantidadeUtilizada;
        
        // Verifica se a quantidade nova não é negativa
        if ($novaQuantidade < 0) {
            throw new Exception("Quantidade insuficiente no estoque para o produto ID: $idProduto");
        }

        // Atualiza o estoque no banco de dados
        $sqlUpdate = "UPDATE servicos_produtos SET quantidade = :novaQuantidade WHERE id_servico_produto = :idProduto";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([
            ':novaQuantidade' => $novaQuantidade,
            ':idProduto' => $idProduto
        ]);
    } else {
        throw new Exception("Produto com ID: $idProduto não encontrado no estoque.");
    }
}









?>