<style>
    /* Estilos para o modal (oculto por padrão) */
.modalFormaPagamento {
  display: none; /* Oculta o modal */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Fundo escuro */
}

/* Estilos para o conteúdo do modal */
.modalFormaContent {
  background-color: white;
  color: black;
  margin: 15% auto; /* Alinha no centro da tela */
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px; /* Largura máxima do modal */
}

/* Estilos para o botão de fechar */
.closeFormaPaga {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.closeFormaPaga:hover,
.closeFormaPaga:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>

<header>
        <!-- Sidebar -->
        <div class="sidebar">
            
            <a href="../pages/cadastrar-funci.php">Cadastrar funcionário</a>
            <a href="../pages/cadastrar-fornecedor.php">Cadastrar fornecedor</a>
            <a href="../pages/forma-pagamento.php">Forma de pagamento</a>
            <a href="../config/sair.php">Sair</a>
        </div>

        
        
        
        <div class="container-header" >
            <button class="button" onclick="window.history.back();">
            <div class="button-box">
                <span class="button-elem">
                <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                    ></path>
                </svg>
                </span>
                <span class="button-elem">
                <svg viewBox="0 0 46 40">
                    <path
                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"
                    ></path>
                </svg>
                </span>
            </div>
            </button>
            <!-- <img src="../image/logo-carcheck.png" alt="Logo CarCheck" title="CarCheck"> -->
            <h1>CarCheck</h1>
        </div>
    
        <div class="icons">
            <!-- Botão para mostrar a notificação
            <button onclick="showNotification()" class="icons-not">
            <i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></button>

             Popup de notificação
            <div id="notification" class="notification">
                <span id="notification-text">Este é um alerta de notificação!</span>
                <span class="close-btn" onclick="closeNotification()">&times;</span>
            </div> -->

            <!-- <a href="pages/notificacao.html"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></a> -->

            <a href="../pages/home-funci.php"><i class="fa-solid fa-house-chimney fa-2xl casa" style="color: #ffffff;"></i></a>
            <a href="../pages/perfil.php"><i class="fa-solid fa-user fa-2xl" style="color: #ffffff;"></i></a>
        </div>
        
        <!-- botao hamburguer side bar -->
        <input type="checkbox" id="checkbox" onclick="toggleSidebar()">
        <label for="checkbox" class="toggle">
            <div class="bar bar--top"></div>
            <div class="bar bar--middle"></div>
            <div class="bar bar--bottom"></div>
        </label>

        <!-- Botão para abrir a sidebar -->
        <!-- <button class="open-btn" onclick="toggleSidebar()">☰</button> -->
        
        <!-- modal para forma de pagamento -->
        <div class="modalFormaPagamento" id="modalFormaPaga">
            <div class="modalFormaContent">
                <span class="closeFormaPaga">&times;</span>
                <h2>Cadatrar forma de pagamento</h2>
                <label for="forma">Forma de pagamento:</label>
                <input type="text" name="forma" id="formaPagamento">

                <button type="submit">Salvar</button>

            </div>
        </div>
</header>

<script src="../js/abrir-modal.js"></script>
<script src="../js/script.js"></script>
<script src="../js/popup-not.js"></script>
