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
            $idTipo = intval($_POST['option']);
            
            if ($selectOptions === "1") {
                if (!empty($_POST['nomeServico']) &&
                    !empty($_POST['descrServico']) &&
                    !empty($_POST['valorServico']) &&
                    !empty($_POST['option'])) {

                $nomeServico = htmlspecialchars($_POST['nomeServico'], ENT_QUOTES, 'UTF-8');
                $descrServico = htmlspecialchars($_POST['descrServico'], ENT_QUOTES, 'UTF-8');
                $valorServico = floatval($_POST['valorServico']);
                
                
                $id_servico = cadastrarServico($pdo, $nomeServico, $descrServico, $valorServico, $idTipo);
                echo "Serviço cadastrado com sucesso!";
            } else {
                echo "Preencha todos os campos do serviço.";
            }
        } 
        elseif ($selectOptions === "2") {      
            if (!empty($_POST['nomeProduto']) &&
                !empty($_POST['descrProduto']) &&
                !empty($_POST['valorProduto']) &&
                !empty($_POST['cnpjFornecedor']) &&
                !empty($_POST['quantidadeProduto'] &&
                !empty($_POST['marcaProduto']))) 
                {
                    $nomeServico = htmlspecialchars($_POST['nomeProduto'], ENT_QUOTES, 'UTF-8');

                    $descrServico = htmlspecialchars($_POST['descrProduto'], ENT_QUOTES, 'UTF-8');

                    $valorUni = floatval($_POST['valorProduto']);

                    $cnpj = htmlspecialchars($_POST['cnpjFornecedor'], ENT_QUOTES, 'UTF-8');

                    $quantidade = intval($_POST['quantidadeProduto']);

                    $nomeMarca = htmlspecialchars($_POST['marcaProduto'], ENT_QUOTES, 'UTF-8');

                    


                    //cadastro
                    $idFornecedor = buscaFornecedor($pdo, $cnpj);

                    $valorTotal = $valorUni * $quantidade;
                
                
                
                    

                    //inserir marca
                    $id_marca = cadastrarMarca($pdo, $nomeMarca);

                    //inserir produto
                    $id_produto = cadastrarProduto($pdo, $nomeServico, $descrServico, $valorUni, $idTipo, $id_marca);
                    
                    //inserir compra
                    $id_compra = cadastrarCompras($pdo, $valorTotal, $idFornecedor);

                    //inserir itens compra
                    $id_itens_compras = cadastrarItensCompra($pdo, $quantidade, $valorUni, $id_produto, $id_compra);

                    echo "Produto e Compra cadastrados com sucesso";
                } else {
                echo "Preencha todos os campos.";
                } 
            } else {
                echo "Nenhuma opção selecionada.";
            }
    
}
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
}
?>