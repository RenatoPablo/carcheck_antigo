<header>
        <!-- Sidebar -->
        <div class="sidebar">
            
            <a href="../pages/cadastrar-funci.php">Cadastrar Funcionário</a>
            <a href="../pages/cadastrar-fornecedor.php">Cadastrar Fornecedor</a>
            <a href="#clients">Clients</a>
            <a href="../config/sair.php">Sair</a>
        </div>
    
        <div class="container-header">
            <img src="../image/logo-carcheck.png" alt="Logo CarCheck" title="CarCheck">
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
</header>

<script src="../js/script.js"></script>
<script src="../js/popup-not.js"></script>
