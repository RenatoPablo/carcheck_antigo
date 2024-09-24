<?php

require '../config/config.php';

function cadastrarCargo($pdo, $nomeCargo) {
    $sql = "SELECT id_cargo FROM cargos WHERE nome_cargo = :cargo";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':cargo' => $nomeCargo]);

    if ($stmtCheck->rowCount > 0) {
        $cargo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $cargo['id_cargo'];
    }

    $sqlInsert = "INSERT INTO cargos(nome_cargo) VALUES (:cargo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':cargo' => $nomeCargo]);
    return $pdo->lastInsertId();
}

function cadastrarFuncoes($pdo, $nomeFuncao) {
    $sql = "SELECT id_funcao FROM funcoes WHERE nome_funcao = :funcoes";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':funcoes' => $nomeFuncao]);

    if ($stmtCheck->rowCount() > 0) {
        $funcao = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $funcao['id_funcao'];
    }
    $sqlInsert = "INSERT INTO funcoes(nome_funcao) VALUES (:funcao)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':funcao' => $nomeFuncao]);
    return $pdo->lastInsertId();
}

function cadastrarFunci($pdo, $id_pessoa, $id_cargo, $id_funcao) {
    $sql = "SELECT f.id_funcionario 
            FROM funcionarios f 
            WHERE f.fk_id_pessoa = :pessoa";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':pessoa' => $id_pessoa]);

    if ($stmtCheck->rowCount() > 0) {
        $funcionario = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $funcionario['id_funcionario'];
    }
    $sqlInsert = "INSERT INTO funcionarios(fk_id_cargo, fk_id_funcao, fk_id_pessoa) VALUES (:cargo, :funcao, :pessoa)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':cargo'  => $id_cargo,
        ':funcao' => $id_funcao,
        ':pessoa' => $id_pessoa
    ]);
    return $pdo->lastInsertId();
}
?>