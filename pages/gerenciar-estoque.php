<?php
    session_start();
    // print_r($_SESSION);
    if(!isset($_SESSION) OR $_SESSION['logado'] != true):
		header("location: ../config/sair.php");		
	else:
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar estoque</title>
    <link rel="stylesheet" href="../css/barra-pesquisa.css">
    <link rel="stylesheet" href="../css/gerenciar-estoque.css">
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/popup-not.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-busca-estoque.css">
    <link rel="stylesheet" href="../css/padraoformularios.css">

</head>
<body>
<?php include '../includes/header-funci.php'; ?>

<div class="busca">
  
  <!-- Checkboxes para tipo de produto -->
  <label>
      <input type="radio" name="tipo" value="1"> Serviço
  </label>
  <label>
      <input type="radio" name="tipo" value="2"> Produto
  </label>
        <!-- barra de pesquisa -->
        <div class="search">
          <input placeholder="Buscar item do estoque" class="search__input" type="text" id="estoque" onkeyup="buscarEstoque()"/>
          <button class="search__button">
            <svg
              viewBox="0 0 16 16"
              class="bi bi-search"
              fill="currentColor"
              height="16"
              width="16"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
              ></path>
            </svg>
          </button>
        </div>
    
    
        <!-- Sugestões aparecerão aqui -->
        <ul id="sugestoes"></ul>
</div>


<!-- Modal -->
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            
            <!-- Formulário do Modal -->
            <form id="crudForm">
                <input type="hidden" id="id_servico_produto" name="id_servico_produto">

                <!-- Campos do item -->
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" readonly>

                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao" name="descricao">

                <label for="valor">Valor:</label>
                <input type="number" id="valor" name="valor">

                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade">

                <!-- Botões de ação -->
                <button type="button" id="saveChangesBtn">Salvar Alterações</button>
                <button type="button" id="deleteBtn">Excluir</button>
            </form>
        </div>
    </div>


<script src="../js/gerenciar-estoque.js"></script>

</body>
</html>
<?php endif; ?>