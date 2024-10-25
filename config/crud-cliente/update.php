<?php 

require '../config.php';

var_dump($_POST);

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (
            !isset($_POST['id']) &&
            !isset($_POST['nome']) && 
            !isset($_POST['email']) && 
            !isset($_POST['telefone']) && 
            !isset($_POST['rua']) && 
            !isset($_POST['numero']) && 
            !isset($_POST['bairro']) && 
            !isset($_POST['cidade']) && 
            !isset($_POST['cep']) && 
            !isset($_POST['complemento']) && 
            !isset($_POST['referencia'])
            ) {
            // Captura os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $referencia = $_POST['referencia'];
    
    // Campos adicionais para pessoa física
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $rg = isset($_POST['rg']) ? $_POST['rg'] : null;

    // Campos adicionais para pessoa jurídica
    $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : null;
    $ie = isset($_POST['ie']) ? $_POST['ie'] : null;
    $razao_social = isset($_POST['razao']) ? $_POST['razao'] : null;
    $nome_fantasia = isset($_POST['fantasia']) ? $_POST['fantasia'] : null;

    echo "VAI SE FUDE";

    // Atualiza os dados no banco de dados (exemplo simplificado)
    $query = "";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':referencia', $referencia);
    
    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados.";
    }

    // Se for pessoa física, atualiza o CPF e RG
    if ($cpf && $rg) {
        $query_fisica = "UPDATE pessoas_fisicas SET cpf = :cpf, rg = :rg WHERE fk_id_pessoa = :id";
        $stmt_fisica = $pdo->prepare($query_fisica);
        $stmt_fisica->bindParam(':cpf', $cpf);
        $stmt_fisica->bindParam(':rg', $rg);
        $stmt_fisica->bindParam(':id', $id);
        $stmt_fisica->execute();
        
    }

    // Se for pessoa jurídica, atualiza o CNPJ e outros dados
    if ($cnpj && $ie) {
        $query_juridica = "UPDATE pessoas_juridicas SET 
                            cnpj = :cnpj, 
                            ie = :ie, 
                            razao_social = :razao_social, 
                            nome_fantasia = :nome_fantasia
                          WHERE fk_id_pessoa = :id";
        $stmt_juridica = $pdo->prepare($query_juridica);
        $stmt_juridica->bindParam(':cnpj', $cnpj);
        $stmt_juridica->bindParam(':ie', $ie);
        $stmt_juridica->bindParam(':razao_social', $razao_social);
        $stmt_juridica->bindParam(':nome_fantasia', $nome_fantasia);
        $stmt_juridica->bindParam(':id', $id);
        $stmt_juridica->execute();
    }
}
        
    } else {
        echo "Nenhum formulario enviado.";
    }
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}

?>