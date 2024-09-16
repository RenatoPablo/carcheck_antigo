<?php
require 'config.php';




function cadastrarRua($pdo, $nomeRua) {
    $sqlCheck = "SELECT id_rua FROM ruas WHERE nome_rua = :nome";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeRua]);

    if ($stmtCheck->rowCount() > 0) {
        $rua = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        echo "Rua ja existe";
        return $rua['id_rua'];
    }
    $sqlInsertRua = "INSERT INTO ruas(nome_rua) VALUES (:nome)";
    $stmtInsert = $pdo->prepare($sqlInsertRua);

    $stmtInsert->execute([':nome' => $nomeRua]);
    return $pdo->lastInsertId();
}

function cadastraNumeroCasa($pdo, $numeroCasa) {
    $sqlCheck = "SELECT id_numero_casa FROM numeros_casas WHERE numero_casa = :numero";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':numero' => $numeroCasa]);

    if ($stmtCheck->rowCount() > 0) {
        $numero = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        echo "Numero ja existe";
        return $numero['id_numero_casa'];
    }
    $sqlInsertNumeroCasa = "INSERT INTO numeros_casas(numero_casa) VALUES (:numero)";
    $stmtInsert = $pdo->prepare($sqlInsertNumeroCasa);

    $stmtInsert->execute([':numero' => $numeroCasa]);
    return $pdo->lastInsertId();
}

function cadastrarBairro($pdo, $nomeBairro) {
    $sqlCheck = "SELECT id_bairro FROM bairros WHERE nome_bairro = :nome";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':nome' => $nomeBairro]);

    if ($stmtCheck->rowCount() > 0) {
        $bairro = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        echo "Bairro ja existe";
        return $bairro['id_bairro'];
    }
    $sqlInsertBairro = "INSERT INTO bairros(nome_bairro) VALUES (:nome)";
    $stmtInsert = $pdo->prepare($sqlInsertBairro);

    $stmtInsert->execute([':nome' => $nomeBairro]);
    return $pdo->lastInsertId();
}

function cadastrarComplemento($pdo, $descComplemento) {
    $sqlCheck = "SELECT id_complemento FROM complementos WHERE desc_complemento = :descr";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':descr' => $descComplemento]);

    if ($stmtCheck->rowCount() > 0) {
        $complemento = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $complemento['id_complemento'];
    }
    $sqlInsertComplemento = "INSERT INTO complementos(desc_complemento) VALUES (:descr)";
    $stmtInsert = $pdo->prepare($sqlInsertComplemento);

    $stmtInsert->execute([':descr' => $descComplemento]);
    return $pdo->lastInsertId();
}

function cadastrarPontoRef($pdo, $descPontoRef) {
    $sqlCheck = "SELECT id_ponto_ref FROM pontos_referencias WHERE desc_ponto_ref = :ponto_ref";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':ponto_ref' => $descPontoRef]);

    if ($stmtCheck->rowCount() > 0) {
        $pontoRef = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $pontoRef['id_ponto_ref'];
    }
    $sqlInsert = "INSERT INTO pontos_referencias(desc_ponto_ref) VALUES (:ponto_ref)";
    $stmtInsert = $pdo->prepare($sqlInsert);

    $stmtInsert->execute([':ponto_ref' => $descPontoRef]);
    return $pdo->lastInsertId();
}

/////////////////////////pessoas/////////////////////////
function cadastrarPessoa($pdo, $nomePessoa, $numTelefone, $enderecoEmail, $senha, $dataNasc) {

    if (!filter_var($enderecoEmail, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Email inválido.');
    }

    $sqlCheck = "SELECT id_pessoa FROM pessoas WHERE endereco_email = :email";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':email' => $enderecoEmail]);

    if ($pessoa = $stmtCheck->fetch(PDO::FETCH_ASSOC)) {
        
        return $pessoa['id_pessoa'];
    }

    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    try {
    $sqlInsert = "INSERT INTO pessoas(nome_pessoa, data_nasc, numero_telefone, endereco_email, senha) VALUES (:nome, :dataNasc, :tele, :email, :senha)";
    $stmtInsert = $pdo->prepare($sqlInsert);
    $stmtInsert->execute([
        ':nome' => $nomePessoa,
        ':dataNasc' => $dataNasc,
        ':tele' => $numTelefone,
        ':email' => $enderecoEmail,
        ':senha' => $hashedSenha
    ]);
    return $pdo->lastInsertId();
    } catch (PDOException $e) {
        throw new Exception('Erro ao cadastrar a pessoa: ' . $e->getMessage());
    }
}

function cadastrarPessoaFisica($pdo, $cpf, $rg, $pessoaId) {
    $sqlInsertPessoaFisica = "INSERT INTO pessoas_fisicas(cpf, rg, fk_id_pessoa) VALUES (:cpf, :rg, :pessoaId)";
    $stmtInsertPessoaFisica = $pdo->prepare($sqlInsertPessoaFisica);
    $stmtInsertPessoaFisica->execute([
        ':cpf' => $cpf,
        ':rg' => $rg,
        ':pessoaId' => $pessoaId
    ]);

    return $pdo->lastInsertId();
}

function cadastrarPessoaJuridica($pdo, $cnpj, $ie, $razao, $fantasia) {
    $sqlCheck = "SELECT id_pessoa_juri FROM pessoas_juridicas WHERE cnpj = :cpnj";
    $stmtCheck = $pdo->prepare($sqlCheck);
    $stmtCheck->execute([':cnpj' => $cnpj]);

    if ($stmtCheck->rowCount() > 0) {
        $juridica = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $juridica['id_pessoa_juridica'];
    }
    $sqlInsert = "INSERT INTO pessoas_juridicas(cnpj, ie, razao_social, nome_fantasia) VALUES (:cnpj, :ie, :razao, :fantasia)";
    $sqlInsert = $pdo->prepare($sqlInsert);
    $sqlInsert->execute([
        ':cnpj'     => $cnpj,
        ':ie'       => $ie,
        ':razao'    => $razao,
        ':fantasia' => $fantasia
    ]);
    return $pdo->lastInsertId();
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