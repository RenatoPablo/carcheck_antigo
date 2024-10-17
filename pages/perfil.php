<?php

    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
        header("location: ../config/sair.php");		
    else:

    

    require '../config/config.php';
    require '../config/busca-perfil.php';
    

    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card-itens.css"><link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/perfil.css">

    <title>Meu Perfil</title>
</head>
<body>

<?php include '../includes/header-funci.php' ?>

    
    <div class="card-perfil">

        <!-- para mostrar a foto -->
        <?php if(!empty($foto)) :?>
        <div>
            <img src="<?php echo $foto; ?>" alt="Foto de perfil de <?php echo $nome; ?>">
        </div>
        <?php else: ?>
        <p>Sem foto de perfil cadastrada</p>
        <?php endif; ?>
        
        <label>Nome: <?php echo $nome ?></label>

        <br>

        <label>Email: <?php echo $email ?></label>

        <br>

        <label>Data nascimento: <?php echo $data_nasc ?></label>

        <br>

        <label>Telefone: <?php echo $telefone ?></label>

        <br>

        <label>CEP: <?php echo $cep ?></label>

        <br>

        <label>Rua: <?php echo $rua ?></label>

        <br>

        <label>Genero: <?php echo $sexo ?></label>

        <br>

        <label>Numero da casa: <?php echo $num_casa ?></label>

        <br>

        <label>Cidade: <?php echo $cidade ?></label>

        <br>

        <label>Bairro: <?php echo $bairro ?></label>

        <br>

        <?php if ($comple != null) : ?>
        <label>Complemento: <?php echo $comple ?></label>
        <?php else: ?>
        <p>Sem complemento</p>
        <?php endif; ?>
        
        <br>

        <?php if ($referencia != null) : ?>
        <label>Ponto de referencia: <?php echo $referencia ?></label>
        <?php else: ?>
        <p>Sem ponto de referencia</p>
        <?php endif; ?>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>
<?php endif; ?>