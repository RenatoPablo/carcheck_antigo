<?php 
    

require '../config/config.php';

function cadastrarFornecedor($pdo, $fantasia, $razao_social, $ie, $cnpj) {
    $sql = "SELECT id_fornecedor FROM fornecedores WHERE cnpj = :cnpj";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cnpj' => $cnpj
    ]);

    if ($stmt->rowCount() > 0) {
        $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $fornecedor['id_fornecedor'];
    }

    $sqlInsert = "INSERT INTO fornecedores(nome_fantasia, razao_social, ie, cnpj) VALUES (:fantasia, :razao, :ie, :cnpj)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':fantasia' => $fantasia,
        ':razao' => $razao_social,
        ':ie' => $ie,
        ':cnpj' => $cnpj
    ]);
    return $pdo->lastInsertId();
}

?>