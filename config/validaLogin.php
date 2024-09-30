<?php
session_start();

if(!isset($_POST) OR empty($_POST['endereco_email']) OR empty($_POST['senha'])) {
    header("location: sair.php");
    exit();
} else {    
    include('config.php');

    // Captura os dados enviados pelo formulário
    $email = $_POST['endereco_email'];
    $senha_digitada = $_POST['senha'];
    

    // Consulta apenas o hash da senha associado ao email
    $sql = "SELECT *
            FROM pessoas
            WHERE endereco_email = :email";

    try {
        $pdo->beginTransaction();
        
        $consulta = $pdo->prepare($sql);
        $consulta->execute(['email' => $email]);

        $count = $consulta->rowCount();

        if ($count != 0) {
            // Busca os dados do usuário
            $linha = $consulta->fetch(PDO::FETCH_OBJ);

            // Verifica se a senha digitada corresponde ao hash no banco de dados
            if (password_verify($senha_digitada, $linha->senha)) {
                // Se a senha estiver correta, cria a sessão
                $_SESSION['logado'] = true;
                $_SESSION['nomeUsuario'] = $linha->nome_pessoa;
                $_SESSION['emailUsuario'] = $linha->endereco_email;
                $_SESSION['permissaoUsuario'] = $linha->fk_id_permissao;

                // Redireciona o usuário de acordo com o nível de permissão
                if ($_SESSION['permissaoUsuario'] == 3 || $_SESSION['permissaoUsuario'] == 2) {
                    $permissao = "funci";
                    header('location: ../pages/home-funci.php');
                } elseif ($_SESSION['permissaoUsuario'] == 1) {
                    $permissao = "cliente";
                    header('location: ../pages/home-cliente.php');
                }
            } else {
                // Senha incorreta
                echo "Usuário ou senha incorretos!<br>";
                echo "<a href='sair.php'>Voltar</a>";
            }
        } else {
            // Caso o email não exista
            echo "Usuário ou senha incorretos!<br>";
            echo "<a href='sair.php'>Voltar</a>";
        }

        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollback();
        $erro = $e->getMessage();
        echo "ERRO: {$erro}";
    }
}
?>
