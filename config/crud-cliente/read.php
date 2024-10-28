<?php 

require '../config.php';

try {
    $sql = "SELECT 
                p.id_pessoa,
                p.nome_pessoa,
                p.data_nasc,
                p.numero_telefone,
                p.endereco_email,
                p.foto,
                pf.cpf,
                pf.rg,
                pj.cnpj,
                pj.ie,
                pj.razao_social,
                pj.nome_fantasia,
                g.sexo AS genero,
                b.nome_bairro,
                c.nome_cidade,
                r.nome_rua,
                nc.numero_casa,
                cp.numero_cep,
                comp.desc_complemento,
                pr.desc_ponto_ref,
                pe.tipo_permissao
            FROM 
                pessoas p
            LEFT JOIN 
                pessoas_fisicas pf ON p.id_pessoa = pf.fk_id_pessoa
            LEFT JOIN 
                pessoas_juridicas pj ON p.id_pessoa = pj.fk_id_pessoa
            LEFT JOIN 
                generos g ON p.fk_id_genero = g.id_genero
            LEFT JOIN 
                bairros b ON p.fk_id_bairro = b.id_bairro
            LEFT JOIN 
                cidades c ON p.fk_id_cidade = c.id_cidade
            LEFT JOIN 
                ruas r ON p.fk_id_rua = r.id_rua
            LEFT JOIN 
                numeros_casas nc ON p.fk_id_numero_casa = nc.id_numero_casa
            LEFT JOIN 
                ceps cp ON p.fk_id_cep = cp.id_cep
            LEFT JOIN 
                complementos comp ON p.fk_id_complemento = comp.id_complemento
            LEFT JOIN 
                pontos_referencias pr ON p.fk_id_ponto_ref = pr.id_ponto_ref
            LEFT JOIN 
                permissoes pe ON p.fk_id_permissao = pe.id_permissao;

            ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obter todos os dados
    $pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC); // Usando fetchAll para obter todos os registros

    
    
    echo json_encode($pessoas);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao buscar pessoa: ' . $e->getMessage()]);
}

?>
