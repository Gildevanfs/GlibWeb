use curso;

show tables;

CREATE table clientes (
	id_cliente int primary key auto_increment,
    nome varchar(50),
    telefone varchar(50),
    email varchar(200),
    cpf varchar(11) unique

);

select * from clientes 
WHERE email
LIKE '%F%';

-- ESTRUTURA DO INSERT
INSERT INTO clientes (data_nascimento)
VALUES ('Giuliano Ferreira', '85963658745','gs@gmail.com', '85457598632'),
('Jhulia Enne', '88830038','je@gmail.com', '0254986532987');

-- ALTERAR DADOS DA COLUNA
UPDATE clientes
SET data_nascimento = NULL
WHERE id_cliente = 4;  

-- INSERIR NOVA COLUNA
ALTER TABLE clientes
ADD  data_nascimento2 date;

-- DELETAR UMA COLUNA
ALTER TABLE clientes
DROP COLUMN data_nascimento2;
