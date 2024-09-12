<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        

        function cadastrarEstado($pdo, $nomeEstado) {
            //verificar se o estado ja existe no banco
            $sqlCheck = "SELECT id_estado FROM estados WHERE nome_estado = :nome";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->execute([':nome' => $nomeEstado]);

            //se o estado ja existir, retorna o ID
            if ($stmtCheck->rowCount() > 0) {
                $estado = $stmtCheck->fetch(PDO::FETCH_ASSOC);
                echo "Estado ja existe";
                return $estado['id_estado']; //retorna o ID do estado existente
            }
            //caso contrario, insere um novo estado
            $sqlInsertEstado = "INSERT INTO estados(nome_estado) VALUES (:nome)";
            $stmtInsert = $pdo->prepare($sqlInsertEstado);
            
            //executa a inserção do novo estados
            $stmtInsert->execute([':nome' => $nomeEstado]);
            
            //retorna o ID do novo estado inserido
            return $pdo->lastInsertId();
        }
        
        function cadastrarcidade($pdo, $nomeCidade, $estadoId) {
            $sqlCheck = "SELECT id_cidade FROM cidades WHERE nome_cidade = :nome";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->execute([':nome' => $nomeCidade]);

            if ($stmtCheck->rowCounts() > 0 ) {
                $cidade = $stmtCheck->fetch(PDO::FETCH_ASSOC);
                echo "Cidade ja existe";
                return $cidade['id_cidade'];
            }
            $sqlInsertCidade = "INSERT INTO cidades(nome_cidade, fk_id_estado) VALUES (:nome, :estadoId)";
            $stmtInsert = $pdo->prepare($sqlInsertCidade);

            $stmtInsert->execute([':nome' => $nomeCidade, ':estadoId' => $estadoId]);
            return $pdo->lastInsertId();
        }

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

            $stmtInsert->execute([':numero', $numeroCasa]);
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

            $stmtInsert->execute([':nome', $nomeBairro]);
            return $pdo->lastInsertId();
        }

        function


        /////////////////////////pessoas/////////////////////////
        function cadastrarPessoa($pdo, $nomePessoa, $numTelefone, $enderecoEmail, $senha,  $ruaId, $cidadeId, $numeroCasaId) {
            $sqlInsertPessoa = "INSERT INTO pessoas(nome_pessoa, numero_telefone, endereco_email, senha, fk_id_estado, fk_id_rua, fk_id_cidade, fk_id_numero_casa) VALUES (:nomePessoa, :numTelefone, :enderecoEmail, :senha, :ruaId, :cidadeId, :numeroCasa)";
            $stmtInsertPessoa = $pdo->prepare($sqlInsertPessoa);
            $stmtInsertPessoa->execute([
                ':nomePessoa' => $nomePessoa,
                ':numTelefone'=> $numTelefone,
                'enderecoEmail' => $enderecoEmail,
                ':senha' => $senha,
                
                ':ruaId' => $ruaId,
                ':cidadeId' => $cidadeId,
                ':numeroCasa' => $numeroCasaId
            ]);

            return $pdo->lastInsertId();
            
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

        if (isset($_POST['estado']) && 
            isset($_POST['rua']) &&
            isset($_POST['cidade']) &&
            isset($_POST´['numero']) &&
            isset($_POST['nome']) && 
            isset($_POST['telefone']) &&
            isset($_POST['email']) &&
            isset($_POST['senha'])) {

            $nomeEstado = $_POST['estado']; //nome estado enviado pelo formulario
            $nomeRua = $_POST['rua'];
            $nomeCidade = $_POST['cidade'];
            $numeroCasa = $_POST['numero'];


            $nomePessoa = $_POST['nome'];
            $numTelefone = $_POST['telefone'];
            $enderecoEmail = $_POST['email'];
            $senha = $_POST['senha'];

            //cadastrar estado
            $estadoId = cadastrarEstado($pdo, $nomeEstado);
            $ruaId = cadastrarRua($pdo, $nomeRua);
            $cidadeId = cadastrarCidade($pdo, $nomeCidade, $estadoId);
            $numeroCasaId = cadastraNumeroCasa($pdo, $numeroCasa);
            

            //cadastrar pessoa com id de estado
            $pessoaId = cadastrarPessoa($pdo, $nomePessoa, $numTelefone, $enderecoEmail, $senha, $estadoId, $ruaId, $cidadeId, $numeroCasaId);

            

            echo "Pessoa cadastrada com sucesso, ID: " . $pessoaId . " ID estado: " . $estadoId . " ID rua: " . $ruaId . " ID cidade: " . $cidadeId;
        }
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
}

?>