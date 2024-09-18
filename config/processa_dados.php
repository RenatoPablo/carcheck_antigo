<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

require 'config.php';
require 'api_cep.php';
require 'funcoes_cadastro_pessoa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    
    
    
    try {
            
            if (!empty($_POST['nome']) && 
                !empty($_POST['genero']) && 
                !empty($_POST['telefone']) && 
                !empty($_POST['email']) && 
                !empty($_POST['datadenascimento']) && 
                !empty($_POST['senha']) && 
                !empty($_POST['confirmarsenha']) && 
                $_POST['senha'] === $_POST['confirmarsenha']) {

                $nomePessoa = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
                $idGenero = intval($_POST['genero']);
                $numTelefone = htmlspecialchars($_POST['telefone'], ENT_QUOTES, 'UTF-8');
                $enderecoEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $dataNasc = $_POST['datadenascimento'];
                $senha = $_POST['senha'];
                
                
                // $cpf = isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf'], ENT_QUOTES, 'UTF-8') : null;
                // $rg = isset($_POST['rg']) ? htmlspecialchars($_POST['rg'], ENT_QUOTES, 'UTF-8') : null;

                if (!empty($_POST['cep']) &&
                    !empty($_POST['cidade']) &&
                    !empty($_POST['estado']) &&
                    !empty($_POST['rua']) &&
                    !empty($_POST['numero']) &&
                    !empty($_POST['bairro'])) {
                        $nomeEstado      = $_POST['estado'];
                        $sigla           = $dadosCep['uf'];
                        $nomeCidade      = $_POST['cidade'];
                        $cep             = $_POST['cep'];
                        $nomeRua         = $_POST['rua'];
                        $numeroCasa      = $_POST['numero'];
                        $nomeBairro      = $_POST['bairro'];
                        $descComplemento = $_POST['complemento'];
                        $descPontoRef    = $_POST['ponto_ref'];
                        // inserir estado
                        $id_estado = inserirEstado($pdo, $nomeEstado);

                        // inserir uf
                        $id_uf = inserirUf($pdo, $sigla, $id_estado);


                        // inserir cidade
                        $id_cidade = inserirCidade($pdo, $nomeCidade, $id_uf);

                        // inserir cep
                        $id_cep = inserirCep($pdo, $cep, $id_cidade);

                        //cadatrar rua
                        $id_rua = cadastrarRua($pdo, $nomeRua);

                        //cadastrar numero casa
                        $id_numero_casa = cadastraNumeroCasa($pdo, $numeroCasa);

                        //cadastrar bairro
                        $id_bairro = cadastrarBairro($pdo, $nomeBairro);

                        //verifica se os campos foram preenchidos
                        if (!empty($_POST['complemento'])) {
                            //cadastrar complemento
                            $id_complemento = cadastrarComplemento($pdo, $descComplemento);
                            $comple_verif = true;                              
                        } else {
                            $comple_verif = false;
                        }
                        if (!empty($_POST['ponto_ref'])) {                                
                            //cadastrar ponto referencia
                            $id_ponto_ref = cadastrarPontoRef($pdo, $descPontoRef);
                            $ponto_verif = true;
                        } else {
                            $ponto_verif = false;
                        }

                        if (!empty($_POST['nome']) &&
                            !empty($_POST['genero']) &&
                            !empty($_POST['telefone']) &&
                            !empty($_POST['email']) &&
                            !empty($_POST['datadenascimento']) &&
                            !empty($_POST['senha']) &&
                            !empty($_POST['confirmarsenha']) &&
                            $_POST['senha'] === $_POST['confirmarsenha']) {

                                $nomePessoa = $_POST['nome'];
                                $numTelefone = $_POST['telefone'];
                                $enderecoEmail = $_POST['email'];
                                $senha = $_POST['senha'];
                                $dataNasc = $_POST['datadenascimento'];
                                $id_genero = $_POST['genero'];
                            }
                        }
                        
                $id_pessoa = cadastrarPessoa($pdo, $nomePessoa, $numTelefone, $enderecoEmail, $senha, $dataNasc, $id_genero, $id_complemento, $id_ponto_ref, $comple_verif, $ponto_verif);

                if (isset($_POST['tipo_pessoa'])) {
                    $tipo_pessoa = $_POST['tipo_pessoa'];

                    if ($tipo_pessoa === 'fisica' && $cpf && $rg) {
                        $sql = "INSERT INTO pessoas_fisicas (cpf, rg, fk_id_pessoa)
                                VALUES (:cpf, :rg, :fk_id_pessoa)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':cpf', $cpf);
                        $stmt->bindParam(':rg', $rg);
                        $stmt->bindParam(':fk_id_pessoa', $id_pessoa);
                        $stmt->execute();
                        
                        echo "Dados de pessoa física inseridos com sucesso";

                    } elseif ($tipo_pessoa === 'juridica') {
                        // Inserir dados de pessoa jurídica
                        $cnpj = htmlspecialchars($_POST['cnpj'], ENT_QUOTES, 'UTF-8');
                        $razao_social = htmlspecialchars($_POST['razao-social'], ENT_QUOTES, 'UTF-8');
                        $ie = htmlspecialchars($_POST['ie'], ENT_QUOTES, 'UTF-8');
                        $nome_fantasia = htmlspecialchars($_POST['nome-fantasia'], ENT_QUOTES, 'UTF-8');    


                        $sql = "INSERT INTO pessoas_juridicas (ie, cnpj, razao_social, nome_fantasia, fk_id_pessoa)
                                VALUES (:ie, :cnpj, :razao_social, :nome_fantasia, :fk_id_pessoa)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':ie', $ie);
                        $stmt->bindParam(':cnpj', $cnpj);
                        $stmt->bindParam(':razao_social', $razao_social);
                        $stmt->bindParam(':nome_fantasia', $nome_fantasia);
                        $stmt->bindParam(':fk_id_pessoa', $id_pessoa);
                        $stmt->execute();

                        echo "Dados de pessoa jurídica inseridos com sucesso";
                    }
            }
        //}
            
        } else {
            echo "Preencha todos os dados pessoais, ou verifique se as senhas coincidem.";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header("Location: ../pages/cadastras-cliente.php");
    exit();
}
?>
