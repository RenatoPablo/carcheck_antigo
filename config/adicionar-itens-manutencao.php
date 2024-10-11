<?php 

require '../config/config.php';
require '../config/adicionar-manutencao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($idManutencao) {
        $itensServico = $_POST['itemListServico'];
        $itensProduto = $_POST['itemListProduto'];
    }
}

?>