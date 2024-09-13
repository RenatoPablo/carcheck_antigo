<?php
header('Content-Type: application/json');

//conexao
include 'config.php';

//funcao para buscar dados do cep na api viacep
function buscarDadosCep($cep) {
    $url = "https://viacep.com.br/ws" . $cep . "/json";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

//funcao para verificar ou inserir estado
function inserirEstado($pdo, $nomeEstado) {
    $sqlCheck = "SELECT id_estado FROM estados WHERE nome_estado = :nome";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeEstado]);

    if ($stmtCheck->rowCount() > 0 ) {
        $estado = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $estado['id_estado'];
    } else {
        $sqlInsert = "INSERT INTO estados(nome_estado) VALUES (:nome)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([':nome'=> $nomeEstado]);
        return $pdo->lastInsertId();
    }
}

function inserirUf($pdo, $sigla, $idEstado) {
    $sqlCheck = "SELECT id_uf FROM ufs WHERE sigla = :sigla AND fk_id_estado = :id_estado";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':sigla' => $sigla, ':id_estado' => $idEstado]);

    if ($stmtCheck->rowCount() > 0) {
        $uf = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $uf['id_uf'];
    } else {
        $sqlInsert = " INSERT INTO ufs (sigla, fk_id_estado) VALUES (:sigla, :id_estado)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([':sigla' => $sigla, ':id_estado' => $idEstado]);
        return $pdo->lastInsertId();
    }
}

function inserirCidade($pdo, $nomeCidade, $idUf) {
    $sqlCheck = "SELECT id_cidade FROM cidades WHERE nome_cidade = :nome AND id_uf = :idUf";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeCidade, ':idUf' => $idUf]);

    if ($stmtCheck->rowCount() > 0 ) {
        $cidade = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        
        return $cidade['id_cidade'];
    }
    $sqlInsertCidade = "INSERT INTO cidades(nome_cidade, fk_id_uf) VALUES (:nome, :idUf)";
    $stmtInsert = $pdo->prepare($sqlInsertCidade);

    $stmtInsert->execute([':nome' => $nomeCidade, ':idUf' => $idUf]);
    return $pdo->lastInsertId();
}

function inserirCep($pdo, $cep, $idCidade) {
    $sqlCheck = "SELECT id_cep FROM ceps WHERE numero_cep = :cep AND fk_id_cidade = :id_cidade";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':cep' => $cep, ':id_cidade' => $idCidade]);

    if ($stmtCheck->rowCount() > 0) {
        return ['message' => 'CEP já cadastrado', 'id_cep' => $stmtCheck->fetch(PDO::FETCH_ASSOC)['id_cep']];
    } else {
        $sqlInsert = "INSERT INTO ceps (numero_cep, fk_id_cidade) VALUES (:cep, :id_cidade)";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([':cep' => $cep, ':id_cidade' => $idCidade]);
        return ['message' => 'CEP cadastrado com sucesso', 'id_cep' => $pdo->lastInsertId()];
    }
}
?>