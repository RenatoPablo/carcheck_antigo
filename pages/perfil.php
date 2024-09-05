<?php

    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
        header("location: ../config/sair.php");		
    else:

    include '../config/config.php';

    try{
        //preparar consulta
        $sql = "
        SELECT nome_pessoa, endereco_email
        FROM pessoas";
        $stmt = $pdo->prepare($sql);

        //executar consulta
        $stmt->execute();

        //pega todos os resultados em um array associado
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($resultados) {
            foreach($resultados as $linhas) {
                //exibir nome e email de casa usuario
                echo "<p>Nome: ". htmlspecialchars($linhas['nome_pessoa']) . "</p>";
                echo "<p>Email: " . htmlspecialchars($linhas['endereco_email']) . "</p>";
                echo "<hr>";
            }
        } else {
            echo "<p>Nenhum usuario encontrado</p>";
        }



    } catch(PDOException $e){
        echo "ERRO: " . $e->getMessage();
    }

?>

<?php endif; ?>