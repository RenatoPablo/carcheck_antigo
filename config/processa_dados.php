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
    
    
    $id_complemento = null;
    $id_ponto_ref = null;
    $cpf = null;
    $rg = null;
    $cnpj = null;
    $ie = null;
    $razao = null;
    $fantasia = null;

    $senha_incorreta = false;
    $verificar_campos = false;
    $sucesso_fisica = false;
    $sucesso_juridica = false;
    
    try {
            
            if (!empty($_POST['nome']) && 
                !empty($_POST['genero']) && 
                !empty($_POST['telefone']) && 
                !empty($_POST['email']) && 
                !empty($_POST['datadenascimento']) && 
                !empty($_POST['senha']) && 
                !empty($_POST['confirmarsenha'])) {

                    if ($_POST['senha'] === $_POST['confirmarsenha']) {

                $nomePessoa = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
                $id_genero = intval($_POST['genero']);
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
                        $nomeEstado = is_array($_POST['estado']) ? $_POST['estado'][0] : $_POST['estado'];
                        $sigla = $dadosCep['uf'];
                        $nomeCidade = is_array($_POST['cidade']) ? $_POST['cidade'][0] : $_POST['cidade'];
                        $cep        = is_array($_POST['cep']) ? $_POST['cep'][0] : $_POST['cep'];
                        $nomeRua    = is_array($_POST['rua']) ? $_POST['rua'][0] : $_POST['rua'];
                        $numeroCasa = is_array($_POST['numero']) ? $_POST['numero'][0] : $_POST['numero'];
                        $nomeBairro = is_array($_POST['bairro']) ? $_POST['bairro'][0] : $_POST['bairro'];
                        $descComplemento = is_array($_POST['complemento']) ? $_POST['complemento'][0] : $_POST['complemento'];
                        $descPontoRef = is_array($_POST['ponto_ref']) ? $_POST['ponto_ref'][0] : $_POST['ponto_ref'];
                        
                        // inserir estado
                        $id_estado = inserirEstado($pdo, $nomeEstado);

                        // inserir uf
                        $id_uf = inserirUf($pdo, $sigla, $id_estado);


                        // inserir cidade
                        $id_cidade = inserirCidade($pdo, $nomeCidade, $id_uf);

                        // inserir cep
                        $id_cep = inserirCep($pdo, $cep, $id_cidade);
                        $id_cep = intval($id_cep);

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

                        
                        }
                        

                $id_pessoa = cadastrarPessoa($pdo, $nomePessoa, $numTelefone, $enderecoEmail, $senha, $dataNasc, $id_genero, $id_complemento, $id_ponto_ref, $id_estado, $id_uf, $id_cidade, $id_cep, $id_rua, $id_numero_casa, $id_bairro, $comple_verif, $ponto_verif);

                

                if (isset($_POST['tipo_pessoa'])) {
                    $tipo_pessoa = $_POST['tipo_pessoa'];

                    if ($tipo_pessoa === 'fisica') {
                        $cpf = $_POST['cpf'];
                        $rg = $_POST['rg'];

                        $id_pessoa_fisica = cadastrarPessoaFisica($pdo, $cpf, $rg, $id_pessoa);

                        // echo "Dados Cliente Físico Cadastrado com ID: " . $id_pessoa_fisica;
                        $sucesso_fisica = true;
                    } elseif ($tipo_pessoa === 'juridica') {
                        $cnpj = $_POST['cnpj'];
                        $ie = $_POST['ie'];
                        $razao = $_POST['razao-social'];
                        $fantasia = $_POST['nome-fantasia'];

                        $id_pessoa_juridica = cadastrarPessoaJuridica($pdo, $cnpj, $ie, $razao, $fantasia, $id_pessoa);

                        // echo "Dados Cliente Jurídico Cadastrado com ID: " . $id_pessoa_juridica;

                        $sucesso_juridica = true;
                    }
            }
        } else {
            $senha_incorreta = true;
        }
            
        } else {
            // echo "Preencha todos os dados pessoais, ou verifique se as senhas coincidem.";
            $verificar_campos = true;
        }

        // Redirecionar para o HTML com parâmetros de resultado
        $url = "../pages/cadastrar-cliente.php?sucesso_fisica=" . ($sucesso_fisica ? 'true' : 'false') .
               "&sucesso_juridica=" . ($sucesso_juridica ? 'true' : 'false') .
               "&senha_incorreta=" . ($senha_incorreta ? 'true' : 'false') .
               "&verificar_campos=" . ($verificar_campos ? 'true' : 'false');
        header("Location: $url");
        exit();

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header("Location: ../pages/cadastrar-cliente.php");
    exit();
}
?>
