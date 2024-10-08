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
        if (!empty($_POST['nome']) &&
            !empty($_POST['descr']) &&
            !empty($_POST['valor']) &&
            !empty($_POST['tipo'])
        ) {
            $nomeServico = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
            $descrServico = htmlspecialchars($_POST['descr'], ENT_QUOTES, 'UTF-8');
            $valor = floatval($_POST['valor']);
            
            
            
            if (isset($_POST['option'])) {
                $selectOptions = $_POST['option'];
            
            if ($selectOptions === 1) {
                
                $idTipo = 1;

                $id_servico = cadastrarServico($pdo, $nomeServico, $descrServico, $valor, $idTipo);
            } elseif ($selectOptions === 2 && !empty($_POST['marca'])) {
                $idTipo = 2;
                $nomeMarca = htmlspecialchars($_POST['marca'], ENT_QUOTES, 'UTF-8');

                //inserir marca
                $id_marca = cadastrarMarca($pdo, $nomeMarca);

                //inserir produto
                $id_produto = cadastrarProduto($pdo, $nomeServico, $descrServico, $valor, $idTipo, $id_marca);
            }
        }
        } else {
            echo "Preencha todos os campos.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>