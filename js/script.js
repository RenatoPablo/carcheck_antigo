document.querySelectorAll('.square').forEach(function(square) {
    square.addEventListener('click', function() {
        alert('Você clicou no botão!');
        // Redirecionar para outra página
        // window.location.href = 'https://www.exemplo.com';
    });
});


/////////////////////////////abrir side bar//////////////////////////////////////////
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('open');
}




