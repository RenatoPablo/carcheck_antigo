<?php 

require '../../config/config.php';
require '../../function/funcoes_forma_pagamento.php';
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!empty($_POST['formaPagamento'])) {

            $formaPagamento = htmlspecialchars($_POST['formaPagamento'], ENT_QUOTES, 'UTF-8');

            $idForma = cadastrarForma($pdo, $formaPagamento);

            
        } else {
            echo "Digite a forma de pagamento";
            exit;
        }
    } else {
        echo "Nenhum formulario enviado";
        exit;
    }
} catch (\Throwable $th) {
    //throw $th;
}

?>