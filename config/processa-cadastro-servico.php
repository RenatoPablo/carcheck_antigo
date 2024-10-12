<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

require '../config/config.php';
require '../function/funcoes-cadastro-servico-produto.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['option'])) {
            $selectOptions = $_POST['option'];
            
            if ($selectOptions === 1) {
                if (!empty($_POST['nomeServico']) &&
                    !empty($_POST['descrServico']) &&
                    !empty($_POST['valorServico']) &&
                    !empty($_POST['option'])) {

                $nomeServico = htmlspecialchars($_POST['nomeServikco'], ENT_QUOTES, 'UTF-8');
                $descrServico = htmlspecialchars($_POST['descr'], ENT_QUOTES, 'UTF-8');
                $valorServico = floatval($_POST['valorServico']);
                
                
                $id_servico = cadastrarServico($pdo, $nomeServico, $descrServico, $valorServico, $idTipo);
            } else {
                //mostrar o popup sobre oq esta faltando
            }
            }
            
    if ($selectOptions === 2 && !empty($_POST['marcaProduto'])) {
        
        
        if (!empty($_POST['nomeProduto']) &&
            !empty($_POST['descrProduto']) &&
            !empty($_POST['valorProduto']) &&
            !empty($_POST['cnpjFornecedor']) &&
            !empty($_POST['quantidadeProduto'])
            
        ) {
            $nomeServico = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
            $descrServico = htmlspecialchars($_POST['descr'], ENT_QUOTES, 'UTF-8');
            $valorUni = floatval($_POST['valor']);
            $cnpj = htmlspecialchars($_POST['cnpjFornecedor'], ENT_QUOTES, 'UFT-8');
            $quantidade = intval($_POST['quantidade']);

            $idFornecedor = buscaFornecedor($pdo, $cnpj);

            $valorTotal = $valorUni * $quantidade;
            
            
            
                
                $nomeMarca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');

                //inserir marca
                $id_marca = cadastrarMarca($pdo, $nomeMarca);

                //inserir produto
                $id_produto = cadastrarProduto($pdo, $nomeServico, $descrServico, $valorUni, $idTipo, $id_marca);

                $id_compra = cadastrarCompras($pdo, $valorTotal, $idFornecedor);

                $id_itens_compras = cadastrarItensCompra($pdo, $quantidade, $valorUni, $id_produto, $id_compra);
            }  else {
            echo "Preencha todos os campos.";
        } }
    
}
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
}
?>