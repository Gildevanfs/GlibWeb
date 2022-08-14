use glib;

create table cad_vendas (
	id_nota int primary key auto_increment,
	data_venda date,
    cod_cliente int,
    foreign key(cod_cliente) references cad_cliente(cod_cliente)
);
/*ALTERA O NOME DA TABELA*/
RENAME TABLE nome_tab to nova_tab;

INSERT INTO cad_vendas (data_venda, cod_cliente) values 
(curdate(), 1);

INSERT INTO itens_venda (id_nota, cod_produto) values 
(1, 1), (1,3), (1,4);

INSERT INTO cad_cliente (nome_cliente, email_cliente, tel_cliente) values 
('Fernando Pinheiro','fpinheiro@glib.com','8588888888'), 
('Vitor Alves','valves@glib.com','8577777777');

select * from cad_cliente;

select * from cad_vendas;
select * from itens_venda;


create table itens_venda (
	id_venda int primary key auto_increment,
    id_nota int,
    cod_produto int,
    foreign key(id_nota) references cabecalho_venda(id_nota),
    foreign key(cod_produto) references cad_produto(cod_produto)
);

ALTER TABLE cad_produto ADD cod_barras int(13) AFTER preco_produto;

ALTER TABLE cad_produto
MODIFY column cod_barras varchar(13);

INSERT INTO cad_produto (desc_produto, preco_produto, cod_barras, vida_util) values 
('Macarrão','3.79', 7894561234823, 3),
('Miojo','2.15', 7895875423659, 6);

select * from cad_produto;


"INSERT INTO cad_pessoa (nome, email, login, senha, telefone, cpf, sexo, data_nascimento) 
        values ('$nome', '$email', '$login', '$senha', '$telefone', '$cpf', '$sexo', '$data_nascimento')";

SELECT * FROM cad_vendas where id_nota =1;
SELECT * FROM cad_cliente where cod_cliente =1;

SELECT * FROM cad_vendas v
JOIN cad_cliente c ON v.cod_cliente = c.cod_cliente
where id_nota =1;

SELECT desc_produto, preco_produto FROM itens_venda v
JOIN cad_produto p ON v.cod_produto = p.cod_produto
where id_nota =1;


SELECT * FROM itens_venda 
where id_nota = 1;
