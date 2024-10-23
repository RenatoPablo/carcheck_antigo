<?php 

require '../../config/config.php';
require '../../function/funcoes_forma_pagamento.php';

try {
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!empty($_POST['formaPagamento'])) {
            
        }

    } else {
        echo "Nenhum formulário enviado.";
    }

} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>