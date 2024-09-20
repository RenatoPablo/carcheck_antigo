<?php 
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

require 'config.php';
require '../function/funcoes-cadastro-veiculo.php';



?>