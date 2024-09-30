// Função para buscar os itens de estoque no banco de dados com AJAX
function buscarEstoque() {
    const input = document.getElementById('estoque'); // Campo de busca
    const sugestoes = document.getElementById('sugestoes'); // Elemento para sugestões
    const query = input.value; // Valor do campo de busca

    // Obtém o valor da checkbox selecionada para o tipo
    const tipoCheckbox = document.querySelector('input[name="tipo"]:checked');
    const tipo = tipoCheckbox ? tipoCheckbox.value : ''; // Se houver checkbox marcada, pega o valor

    // Limpar a lista de sugestões e ocultá-la se o campo estiver vazio
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none'; // Ocultar sugestões
        return;
    }

    // Fazer a requisição AJAX para buscar no estoque
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/busca-estoque.php?query=' + encodeURIComponent(query) + '&tipo=' + encodeURIComponent(tipo), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const itens = JSON.parse(xhr.responseText);
            sugestoes.innerHTML = '';

            // Se não houver sugestões, ocultar a lista
            if (itens.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                sugestoes.style.display = 'block'; // Mostrar sugestões

                // Limitar a lista a no máximo 10 itens
                const maxItens = Math.min(itens.length, 10);
                for (let i = 0; i < maxItens; i++) {
                    const item = itens[i];
                    const li = document.createElement('li');
                    li.textContent = item.nome_servico_produto;
                    li.onclick = function() {
                        input.value = item.nome_servico_produto; // Preencher o input com o nome selecionado
                        sugestoes.innerHTML = ''; // Limpar as sugestões
                        sugestoes.style.display = 'none'; // Ocultar a lista de sugestões
                    };
                    sugestoes.appendChild(li);
                }
            }
        }
    };
    xhr.send();
}
