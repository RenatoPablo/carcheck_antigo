// Função para buscar os itens de estoque no banco de dados com AJAX
function buscarEstoque() {
    const input = document.getElementById('estoque'); // Campo de busca
    const sugestoes = document.getElementById('sugestoes'); // Elemento para sugestões
    const query = input.value.trim(); // Valor do campo de busca

    // Obtém o valor do radio selecionado (1 para Serviço ou 2 para Produto)
    const tipoCheckbox = document.querySelector('input[name="tipo"]:checked');
    const tipo = tipoCheckbox ? tipoCheckbox.value : ''; // Se houver radio marcado, pega o valor

    // Se o campo de busca estiver vazio, limpa e oculta a lista de sugestões
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none'; // Ocultar sugestões
        return;
    }

    // Verifica se o tipo foi selecionado (Serviço ou Produto)
    if (!tipo) {
        alert('Por favor, selecione o tipo: Serviço ou Produto.');
        return;
    }

    // Fazer a requisição AJAX para buscar itens de estoque
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/busca-estoque.php?query=' + encodeURIComponent(query) + '&tipo=' + encodeURIComponent(tipo), true);

    xhr.onload = function() {
        if (xhr.status === 200) {
            const itens = JSON.parse(xhr.responseText); // Parseia o JSON retornado pelo servidor
            sugestoes.innerHTML = ''; // Limpa a lista de sugestões

            // Se não houver sugestões, oculta a lista
            if (itens.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                sugestoes.style.display = 'block'; // Mostra sugestões

                // Limitar a lista a no máximo 10 itens
                const maxItens = Math.min(itens.length, 10);
                for (let i = 0; i < maxItens; i++) {
                    const item = itens[i];
                    const li = document.createElement('li');

                    // Adiciona uma classe à <li> para estilização
                    li.classList.add('sugestao-item');

                    // Texto principal do item (nome)
                    const itemName = document.createElement('span');
                    itemName.textContent = item.nome_servico_produto;
                    li.appendChild(itemName);

                    // Cria um botão para abrir o modal
                    const btn = document.createElement('button');
                    btn.textContent = 'Editar';
                    btn.classList.add('btn-modal');
                    btn.onclick = function() {
                        openModal(item); // Abre o modal com os detalhes do item
                    };
                    li.appendChild(btn);

                    // Adiciona o item na lista de sugestões
                    sugestoes.appendChild(li);
                }
                sugestoes.classList.add('sugestoes-lista');
            }
        } else {
            console.error('Erro ao buscar estoque:', xhr.status);
        }
    };

    // Envia a requisição AJAX
    xhr.send();
}

// Função para abrir o modal com detalhes do item
function openModal(item) {
    const modal = document.getElementById('myModal'); // Obtém o modal pelo ID
    const modalText = document.getElementById('modal-text'); // Obtém o elemento onde os detalhes serão exibidos

    // Insere os detalhes do item no modal (nome, descrição, preço)
    modalText.textContent = `Nome: ${item.nome_servico_produto} - Descrição: ${item.descricao} - Preço: ${item.valor_servico_produto}`;
    modal.style.display = 'block'; // Exibe o modal
}

// Função para fechar o modal ao clicar no botão de fechar
document.querySelector('.close').onclick = function() {
    document.getElementById('myModal').style.display = 'none'; // Fecha o modal
};

// Fecha o modal ao clicar fora da área de conteúdo
window.onclick = function(event) {
    const modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = 'none'; // Fecha o modal
    }
};
