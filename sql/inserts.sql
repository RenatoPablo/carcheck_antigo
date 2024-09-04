INSERT INTO ruas(nome_rua)
VALUES
	('rua belgica'),
    ('rua alberto alvez de andrade'),
    ('rua mario camargo');
    
INSERT INTO estados(nome_estado)
VALUES
	('São Paulo');
    
INSERT INTO ufs(sigla)
VALUES 
	('SP');
    
INSERT INTO complementos(desc_complemento)
VALUES
	('casa');
    
INSERT INTO pontos_referencias(desc_ponto_ref)
VALUES
	('n/a');

INSERT INTO numeros_casas(numero_casa)
VALUES
	(21),
    (353),
    (101);
    
INSERT INTO cidades(nome_cidade)
VALUES
	('Santa Fé do Sul'),
    ('Suzanápolis');
    
INSERT INTO bairros(nome_bairro)
VALUES
	('Jardim Europa 3'),
    ('Centro'),
    ('Coronel Araujo');
    
INSERT INTO ceps(numero_cep)
VALUES
	(15775000),
    (15380000);

INSERT INTO generos(sexo)
VALUES
	('Masculino'),
    ('Feminino'),
    ('Outro');

INSERT INTO permissoes(tipo_permissao)
VALUES
    ('cliente'),
    ('funcionario'),
    ('admin');
    
INSERT INTO pessoas(nome_pessoa, numero_telefone, endereco_email, senha, data_nasc, cpf_cnpj, fk_id_permissao, fk_id_cep, fk_id_estado, fk_id_rua, fk_id_genero, fk_id_uf, fk_id_numero_casa, fk_id_cidade, fk_id_bairro, fk_id_complemento, fk_id_ponto_ref)
VALUES
	('Renato Pablo Cuim Ferrarezi', '17997782137', 'renatocuim@gmail.com', '76028462b3ec05267dd142a0e93a401318bb7704', '2004-03-26', '45244973827', 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
    ('Gabriela Batista Matos', '18997610162', 'gabi_batistamatos@hotmail.com', '76028462b3ec05267dd142a0e93a401318bb7704', '2003-01-26', '12312312312', 1, 2, 1, 2, 2, 1, 2, 2, 2, 1, 1),
    ('Joâo Pedro Gonçalves Pinheirinho ', '17997713350', 'trove.eu69@gmail.com', '76028462b3ec05267dd142a0e93a401318bb7704', '2002-10-07', '111111111000100', 2, 1, 1, 3, 3, 1, 3, 1, 3, 1, 1);