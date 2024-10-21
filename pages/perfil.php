<?php
    session_start();
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
    <link rel="stylesheet" href="../css/card-itens.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/perfil.css"> 
    <title>Meu Perfil</title>
    <style>
        /* Estilo para a área de visualização da imagem de perfil */
        .perfil-foto {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f8f8;
        }

        .perfil-foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .custom-file-upload {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #0d3587;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-upload {
            margin-top: 10px;
            padding: 6px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include '../includes/header-funci.php'; ?>

<main class="perfil-container">
    <section class="perfil-header">
        <!-- para mostrar a foto -->
        <div class="perfil-foto" id="perfilFoto">
            <?php if(!empty($foto)) : ?>
                <img src="<?php echo $foto; ?>" alt="Foto de perfil de <?php echo $nome; ?>">
            <?php else : ?>
                <p>Sem foto de perfil</p>
            <?php endif; ?>
        </div>

        <!-- Botões e formulário para alterar a foto, agora abaixo da foto -->
        <div class="foto-actions">
            <form action="../config/upload-foto.php" method="POST" enctype="multipart/form-data">
                <label for="fotoPerfil" class="custom-file-upload">Alterar Foto</label>
                <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*" onchange="previewImage(event)">
                <button type="submit" class="btn-upload">Salvar Foto</button>
            </form>
        </div>

        <div class="perfil-info">
            <h1><?php echo $nome ?></h1>
            <p><?php echo $email ?></p>
        </div>
    </section>

    <section class="perfil-detalhes">
        <!-- Informações de Contato -->
        <div class="perfil-card">
            <h3>Informações de Contato</h3>
            <div class="input-container">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" value="<?php echo $telefone ?>" readonly>
            </div>
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="text" id="email" value="<?php echo $email ?>" readonly>
            </div>
        </div>

        <!-- Informações Pessoais abaixo das Informações de Contato -->
        <div class="perfil-card">
            <h3>Informações Pessoais</h3>
            <div class="input-container">
                <label for="data-nasc">Data de Nascimento:</label>
                <input type="text" id="data-nasc" value="<?php echo $data_nasc ?>" readonly>
            </div>
            <div class="input-container">
                <label for="sexo">Gênero:</label>
                <input type="text" id="sexo" value="<?php echo $sexo ?>" readonly>
            </div>
        </div>

        <!-- Endereço -->
        <div class="perfil-card">
            <h3>Endereço</h3>
            <div class="input-container">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" value="<?php echo $cep ?>" readonly>
            </div>
            <div class="input-container">
                <label for="rua">Rua:</label>
                <input type="text" id="rua" value="<?php echo $rua ?>" readonly>
            </div>
            <div class="input-container">
                <label for="num-casa">Número:</label>
                <input type="text" id="num-casa" value="<?php echo $num_casa ?>" readonly>
            </div>
            <div class="input-container">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" value="<?php echo $cidade ?>" readonly>
            </div>
            <div class="input-container">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" value="<?php echo $bairro ?>" readonly>
            </div>
            <div class="input-container">
                <label for="comple">Complemento:</label>
                <input type="text" id="comple" value="<?php echo $comple ?: 'N/A' ?>" readonly>
            </div>
            <div class="input-container">
                <label for="referencia">Ponto de Referência:</label>
                <input type="text" id="referencia" value="<?php echo $referencia ?: 'N/A' ?>" readonly>
            </div>
        </div>
    </section>

     <!-- Botão de sair -->
    <div class="logout-container">
         <a href="" class="logout-button">Sair</a>
    </div>

</main>

<script>
// Função para pré-visualizar a imagem diretamente no círculo de perfil
function previewImage(event) {
    const perfilFoto = document.getElementById('perfilFoto');
    const file = event.target.files[0];
    
    // Verifica se um arquivo foi selecionado
    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            perfilFoto.innerHTML = `<img src="${e.target.result}" alt="Pré-visualização da imagem">`;
        };

        reader.readAsDataURL(file); // Lê o arquivo como URL
    }
}
</script>

</body>
</html>
<?php endif; ?>
