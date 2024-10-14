<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

require '../config/config.php';
require '../function/funcoes_notas.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        

        if( !empty($_POST['km']) &&
            !empty($_POST['placa'])) 
            {
                $time = $_POST['time-final'];
                $km = $_POST['km'];
                $defeito = $_POST['defeito'];
                $placa = $_POST['placa'];

                $itensServico = json_decode($_POST['itemListServico'], true);

                    if (!is_array($itensServico)) {
                        $itensServico = [];
                    } 

                $itensProduto = json_decode($_POST['itemListProduto'], true);

                    if (!is_array($itensProduto)) {
                        $itensProduto = [];
                    } 


                //var_dump($itensServico, $itensProduto);
                

                $idVeiculo = obterIdVeiculo($pdo, $placa);

                $idManutencao = cadastrarManutencao($pdo, $time, $km, $defeito, $idVeiculo);

                foreach ($itensServico as $item) {
                    cadastrarItensManutencao($pdo, $idManutencao, $item['id'], $item['valor']);
                }

                foreach ($itensProduto as $item) {
                    cadastrarItensManutencao($pdo, $idManutencao, $item['id'], $item['valor'], $item['quantidade']);
                }
                echo "Manutenção cadastrada com sucesso!";
            } else {
                echo "Preencha todos os campos.";
            }
        
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>
