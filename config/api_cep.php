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

    // Verificar se as chaves necessárias existem
    if (!isset($dadosCep['uf']) || !isset($dadosCep['localidade']) || !isset($dadosCep['bairro'])) {
        return ['erro' => true, 'mensagem' => 'Dados incompletos retornados pela API do ViaCEP'];
    }

    // Retornar os dados completos
    return $dadosCep;
}




?>