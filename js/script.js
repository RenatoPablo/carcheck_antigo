// Adiciona um evento de clique a todos os elementos com a classe 'square'
document.querySelectorAll('.square').forEach(function(square) {
    square.addEventListener('click', function() {
        alert('Você clicou no botão!');
        // Redirecionar para outra página (opcional)
        // window.location.href = 'https://www.exemplo.com';
    });
});

// Função para abrir/fechar a sidebar e ajustar os ícones
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('open');

    // Adicione ou remova a classe ajustada para os ícones
    const icons = document.querySelector('.icons');
    icons.classList.toggle('adjusted');
}

