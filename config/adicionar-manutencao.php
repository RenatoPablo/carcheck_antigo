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

        //variavel para verificação se a nota foi cadastrada
        $verificacao = false;

        if( !empty($_POST['km']) &&
            !empty($_POST['placa'])) 
            {
                $time = $_POST['time-final'];
                $km = $_POST['km'];
                $defeito = $_POST['defeito'];
                $placa = $_POST['placa'];

                

                $idVeiculo = obterIdVeiculo($pdo, $placa);

                $idManutencao = cadastrarManutencao($pdo, $time, $km, $defeito, $idVeiculo);

            } else {
                echo "Preencha todos os campos.";
            }
        
    }
} catch (PDOException $e) {
    //throw $th;
}

?>
