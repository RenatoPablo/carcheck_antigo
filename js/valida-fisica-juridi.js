document.addEventListener("DOMContentLoaded", function() {
    // Pegando os elementos dos campos
    const camposFisica = document.getElementById("campos-fisica");
    const camposJuridica = document.getElementById("campos-juridica");

    // Pegando os elementos dos radio buttons
    const radioFisica = document.querySelector('input[name="tipo_pessoa"][value="fisica"]');
    const radioJuridica = document.querySelector('input[name="tipo_pessoa"][value="juridica"]');

    // Função para esconder ou mostrar os campos
    function toggleCampos() {
        if (radioFisica.checked) {
            camposFisica.style.display = "block";
            camposJuridica.style.display = "none";
        } else if (radioJuridica.checked) {
            camposFisica.style.display = "none";
            camposJuridica.style.display = "block";
        }
    }

    // Event listeners para quando o usuário selecionar um dos radio buttons
    radioFisica.addEventListener("change", toggleCampos);
    radioJuridica.addEventListener("change", toggleCampos);

    // Executa a função na inicialização para garantir que os campos estejam corretos
    toggleCampos();
});
