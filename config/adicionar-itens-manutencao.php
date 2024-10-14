<?php 

require '../config/config.php';
require '../config/adicionar-manutencao.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        $itensServico = $_POST['itemListServico'];
        $itensProduto = $_POST['itemListProduto'];

        var_dump($itensServico, $itensProduto);
    
}

?>