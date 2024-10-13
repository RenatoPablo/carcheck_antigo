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
    $sql = "INSERT INTO manutencoes(time_saida, km, defeito, fk_id_veiculo) VALUES (:hora, :km, :defeito, :idVeiculo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':hora' => $time,
        ':km'   => $km,
        ':defeito' => $defeito,
        ':idVeiculo' => $idVeiculo
    ]);
}



?>