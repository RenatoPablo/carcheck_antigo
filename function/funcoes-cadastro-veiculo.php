<<?php 

require 'config.php';

function buscarProprietario ($pdo, $nomeProprie) {
    $sqlCheck = "SELECT id_pessoa FROM pessoas WHERE nome_pessoa = :nome";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeProprie]);

    if ($stmtCheck->rowCount() > 0) {
        $proprietario = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $proprietario['id_pessoa'];
    } else {
        echo "Proprietário não cadastrado.";
    }
}

function cadastrarCor($pdo, $cor) {
    $sql = "SELECT id_cor FROM cores WHERE nome_cor = :cor";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':cor' => $cor]);
    
    if ($stmtCheck->rowCount() > 0) {
        $cor = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        return $cor['id_cor'];
    }

    $sqlInsert = "INSERT INTO cor(nome_cor) VALUES (:cor)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':cor' => $cor]);

    return $pdo->lastInsertId();
}

function cadastrarPlaca ($pdo, $placa) {
    $sql = "INSERT INTO veiculos(placa) VALUES (:placa)";
    $stmtInsert = $pdo->prepare($sql);
    $stmtInsert->execute([':placa' => $placa]);

    return $pdo->lastInsertId();
}

?>