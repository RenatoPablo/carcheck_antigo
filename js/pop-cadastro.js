// Função para abrir o popup
function openPopup() {
    document.getElementById("myModal").classList.add("show");
}

// Função para fechar o popup
function closePopup() {
    document.getElementById("myModal").classList.remove("show");
}

// Fechar o modal ao clicar fora dele
window.onclick = function(event) {
    let modal = document.getElementById("myModal");
    if (event.target === modal) {
        closePopup();  // Fecha o popup se clicar fora da área do modal
    }
}