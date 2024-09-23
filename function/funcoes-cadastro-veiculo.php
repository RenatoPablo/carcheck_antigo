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

    $sqlInsert = "INSERT INTO cores(nome_cor) VALUES (:cor)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':cor' => $cor]);

    return $pdo->lastInsertId();
}

function cadastrarModelo($pdo, $nomeModelo) {
    $sql = "SELECT id_modelo FROM modelos WHERE nome_modelo = :modelo";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':modelo' => $nomeModelo]);

    if($stmtCheck->rowCount() > 0) {
        $modelo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $modelo['id_modelo'];
    }

    $sqlInsert = "INSERT INTO modelos(nome_modelo) VALUES (:modelo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':modelo' => $nomeModelo]);
    return $pdo->lastInsertId();
}

function cadastrarMarcas($pdo, $marca) {
    $sql = "SELECT id_marca FROM marcas WHERE nome_marca = :marca";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':marca' => $marca]);

    if ($stmtCheck->rowCount() > 0) {
        $marca = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $marca['id_marca'];
    }
    $sqlInsert = "INSERT INTO marcas(nome_marca) VALUES (:marca)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':marca' => $marca]);
    return $pdo->lastInsertId();
}

function cadastrarTipoVeiculo($pdo, $tipoVeiculo) {
    $sql = "SELECT id_tipo_veiculo FROM tipos_veiculos WHERE nome_tipo_veiculo = :tipo";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':tipo' => $tipoVeiculo]);

    if ($stmtCheck->rowCount() > 0) {
        $tipo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $tipo['id_tipo_veiculo'];
    }

    $sqlInsert = "INSERT INTO tipos_veiculos(nome_tipo_veiculo) VALUES (:tipo)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':tipo' => $tipoVeiculo]);
    return $pdo->lastInsertId();
}

function cadastrarVeiculo ($pdo, $idProprietario, $placa, $idCor, $idModelo, $idMarca, $idTipoVeiculo) {
    $sql = "SELECT id_veiculo FROM veiculos WHERE placa = :placa";
    $stmtCheck = $pdo->prepare($sql);
    $stmtCheck->execute([':placa' => $placa]);

    if ($stmtCheck->rowCount() > 0) {
        $veiculo = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $veiculo['id_veiculo'];
    }

    $sqlInsert = "INSERT INTO veiculos(fk_id_pessoa, placa, fk_id_cor, fk_id_tipo_veiculo, fk_id_modelo, fk_id_marca) VALUES (:propri, :placa, :cor, :tipo, :modelo, :marca)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':propri' => $idProprietario,
        ':placa'  => $placa,
        ':cor'    => $idCor,
        ':tipo'   => $idTipoVeiculo,
        ':modelo' => $idModelo,
        ':marca'  => $idMarca
    ]);

    return $pdo->lastInsertId();
}

?>