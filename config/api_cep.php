<?php
header('Content-Type: application/json');

//conexao
require 'config.php';


//funcao para buscar dados do cep na api viacep
function buscarDadosCep($cep) {
    // Validar o formato do CEP (8 dígitos)
    if (!preg_match('/^[0-9]{8}$/', $cep)) {
        return ['erro' => true, 'mensagem' => 'CEP inválido, deve conter 8 dígitos numéricos'];
    }

    // Montar a URL da API
    $url = "https://viacep.com.br/ws/{$cep}/json";

    // Fazer requisição para a API
    $response = @file_get_contents($url);

    // Verificar se houve sucesso na requisição
    if ($response === FALSE) {
        return ['erro' => true, 'mensagem' => 'Falha ao se conectar à API do ViaCEP'];
    }

    // Decodificar resposta JSON
    $dadosCep = json_decode($response, true);

    // Verificar se o CEP foi encontrado
    if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
        return ['erro' => true, 'mensagem' => 'CEP não encontrado'];
    }

    return $dadosCep;
}

//funcao para verificar ou inserir estado
function inserirEstado($pdo, $nomeEstado) {
    // Verifica se o estado já existe
    $sqlCheck = "SELECT id_estado FROM estados WHERE nome_estado = :nome";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeEstado]);

    if ($stmtCheck->rowCount() > 0) {
        $estado = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $estado['id_estado'];
    }

    // Insere o estado se não existir
    $sqlInsert = "INSERT INTO estados (nome_estado) VALUES (:nome)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':nome' => $nomeEstado]);

    return $pdo->lastInsertId();
}



function inserirUf($pdo, $sigla, $idEstado) {
    // Verifica se o UF já existe apenas pela sigla
    $sqlCheck = "SELECT id_uf FROM ufs WHERE sigla = :sigla";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':sigla' => $sigla]);

    if ($stmtCheck->rowCount() > 0) {
        $uf = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $uf['id_uf'];
    }

    // Insere o UF se não existir
    $sqlInsert = "INSERT INTO ufs (sigla, fk_id_estado) VALUES (:sigla, :idEstado)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':sigla' => $sigla, ':idEstado' => $idEstado]);

    return $pdo->lastInsertId();
}




function inserirCidade($pdo, $nomeCidade, $idUf) {
    // Verifica se a cidade já existe
    $sqlCheck = "SELECT id_cidade FROM cidades WHERE nome_cidade = :nome AND fk_id_uf = :idUf";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeCidade, ':idUf' => $idUf]);

    if ($stmtCheck->rowCount() > 0) {
        $cidade = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $cidade['id_cidade'];
    }

    // Insere a cidade se não existir
    $sqlInsert = "INSERT INTO cidades (nome_cidade, fk_id_uf) VALUES (:nome, :idUf)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':nome' => $nomeCidade, ':idUf' => $idUf]);

    return $pdo->lastInsertId();
}



function inserirCep($pdo, $cep, $idCidade) {
    // Verificar se o CEP já existe no banco de dados
    $sqlCheck = "SELECT id_cep FROM ceps WHERE numero_cep = :cep AND fk_id_cidade = :id_cidade";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':cep' => $cep, ':id_cidade' => $idCidade]);

    // Se o CEP já existir, retornar a mensagem e o ID do CEP
    if ($stmtCheck->rowCount() > 0) {
        return ['message' => 'CEP já cadastrado', 'id_cep' => $stmtCheck->fetch(PDO::FETCH_ASSOC)['id_cep']];
    }

    // Caso contrário, inserir o novo CEP
    $sqlInsert = "INSERT INTO ceps (numero_cep, fk_id_cidade) VALUES (:cep, :id_cidade)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([':cep' => $cep, ':id_cidade' => $idCidade]);

    // Retornar a mensagem de sucesso e o ID do novo CEP
    return ['message' => 'CEP cadastrado com sucesso', 'id_cep' => $pdo->lastInsertId()];
}

?>