function buscarFornecedores() {
    const input = document.getElementById('cnpjFornecedor');
    const sugestoes = document.getElementById('sugestoes');
    const query = input.value;

    // Limpar a lista de sugestões e ocultá-la se o campo estiver vazio
    if (query.length === 0) {
        sugestoes.innerHTML = '';
        sugestoes.style.display = 'none'; // Ocultar sugestões
        return;
    }

    // Fazer a requisição AJAX para buscar os fornecedores
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../config/buscar_fornecedores.php?cnpj=' + encodeURIComponent(query), true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const fornecedores = JSON.parse(xhr.responseText);
            sugestoes.innerHTML = '';

            // Se não houver sugestões, também ocultar a lista
            if (fornecedores.length === 0) {
                sugestoes.style.display = 'none';
            } else {
                sugestoes.style.display = 'block'; // Mostrar sugestões

                // Limitar a lista a no máximo 10 itens
                const maxItens = Math.min(fornecedores.length, 10);
                for (let i = 0; i < maxItens; i++) {
                    const fornecedor = fornecedores[i];
                    const li = document.createElement('li');
                    li.textContent = fornecedor.nome_fornecedor; // Exibir nome do fornecedor
                    li.onclick = function() {
                        input.value = fornecedor.nome_fornecedor; // Preencher o input com o nome selecionado
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
