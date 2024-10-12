<?php 
    session_start();
    if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
        header("location: ../config/sair.php");
        exit();	
    }

require '../config/config.php';
require '../function/funcoes_cadastro_fornecedor.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

      if (!empty($_POST['nome_fantasia']) &&
          !empty($_POST['razao_social']) &&
          !empty($_POST['ie']) &&
          !empty($_POST['cnpj'])) {
            $fantasia = $_POST['nome_fantasia'];
            $razao = $_POST['razao_social'];
            $ie = $_POST['ie'];
            $cnpj = $_POST['cnpj'];

            $id_fornecedor = cadastrarFornecedor($pdo, $fantasia, $razao, $ie, $cnpj);
          }
        } catch (PDOException $e) {
          echo "Erro: " . $e->getMessage();
        }
  }

?>