<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();    
}

// Importar arquivos
require 'config.php';
require 'api_cep.php';
require 'funcoes_cadastro_pessoa.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Captura o CEP enviado pelo formulário
        $cep = isset($_POST['cep']) ? $_POST['cep'] : null;

        if ($cep) {
            // Buscar dados do CEP
            $dadosCep = buscarDadosCep($cep);

            // Verificar se houve erro ao buscar o CEP
            if (isset($dadosCep['erro']) && $dadosCep['erro'] === true) {
                echo json_encode(['success' => false, 'message' => 'CEP inválido']);
                exit();  // Para a execução após a mensagem de erro
            }

            // Supondo que os dados do CEP estejam corretos e venham com 'uf' e 'estado'
            $nomeEstadoCompleto = $dadosCep['estado']; // Nome completo do estado
            $siglaEstado = $dadosCep['uf']; // Sigla do estado, ex: "SP"

            // Inserir o nome do estado na tabela de estados
            $idEstado = inserirEstado($pdo, $nomeEstadoCompleto);
 
            // Inserir a sigla do estado na tabela de UFs (usando a chave estrangeira do estado)
            $idUf = inserirUf($pdo, $siglaEstado, $idEstado);

            // Inserir a cidade usando a referência de UF
            $idCidade = inserirCidade($pdo, $dadosCep['localidade'], $idUf);

            // Inserir o CEP
            $response = inserirCep($pdo, $cep, $idCidade);

            // Retorna a resposta em formato JSON
            echo json_encode(['success' => true, 'message' => $response['message'], 'id_cep' => $response['id_cep']]);
            var_dump($dadosCep);
        } else {
            // Caso o CEP não tenha sido informado
            echo json_encode(['success' => false, 'message' => 'CEP não informado']);
        }

    } catch (PDOException $e) {
        // Captura e exibe erros de banco de dados
        echo json_encode(['success' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()]);
    }
} else {
    // Caso o método não seja POST
    echo json_encode(['success' => false, 'message' => 'Método não suportado']);
}
?>
