<?php
session_start();
if (!isset($_SESSION) OR $_SESSION['logado'] != true) {
    header("location: ../config/sair.php");
    exit();	
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['estado'])) {
                
        
        
            if (!empty($_POST['nome']) && 
                !empty($_POST['genero']) && 
                !empty($_POST['telefone']) && 
                !empty($_POST['email']) && 
                !empty($_POST['datadenascimento']) && 
                !empty($_POST['senha']) && 
                !empty($_POST['confirmarsenha']) && 
                $_POST['senha'] === $_POST['confirmarsenha']) {

                $nome = htmlspecialchars($_POST['nome'], ENT_QUOTES, 'UTF-8');
                $genero = intval($_POST['genero']);
                $telefone = htmlspecialchars($_POST['telefone'], ENT_QUOTES, 'UTF-8');
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $data_nasc = $_POST['datadenascimento'];
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                $cpf = isset($_POST['cpf']) ? htmlspecialchars($_POST['cpf'], ENT_QUOTES, 'UTF-8') : null;
                $rg = isset($_POST['rg']) ? htmlspecialchars($_POST['rg'], ENT_QUOTES, 'UTF-8') : null;

                $sql_pessoas = "INSERT INTO pessoas(nome_pessoa, fk_id_genero, numero_telefone, endereco_email, data_nasc, senha)
                                VALUES (:nome_pessoa, :genero, :telefone, :email, :data_nasc, :senha)";
                $stmt = $pdo->prepare($sql_pessoas);
                $stmt->bindParam(':nome_pessoa', $nome);
                $stmt->bindParam(':genero', $genero);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':data_nasc', $data_nasc);
                $stmt->bindParam(':senha', $senha);
                $stmt->execute();

                $id_pessoa = $pdo->lastInsertId();

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
        }
            
        } else {
            echo "Por favor, preencha corretamente todos os dados, e verifique se as senhas coincidem";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    header("Location: ../pages/cadastras-cliente.php");
    exit();
}
?>
