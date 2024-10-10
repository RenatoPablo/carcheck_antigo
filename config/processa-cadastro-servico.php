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
            $idTipo = $_POST['option'];
            
            if ($idTipo === 1) {
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
        }
        if (!empty($_POST['nome']) &&
            !empty($_POST['descr']) &&
            !empty($_POST['valor']) &&
            !empty($_POST['option'])
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