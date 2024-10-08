<?php 

require '../config/config.php';

function cadastrarManutencao($pdo, $time, $km, $defeito, $idVeiculo, $idPagamento) {
    $sql = "INSERT INTO manutencoes(time_saida, km, defeito, fk_id_veiculo, fk_id_pagamento) VALUES ";
}

?>