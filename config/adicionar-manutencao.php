<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

require '../config/config.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    }
} catch (PDOException $e) {
    //throw $th;
}

?>
