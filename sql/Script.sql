use glib;
select senha from cad_pessoa where id_pessoa =2;

show TABLES;

update cad_pessoa 
SET senha = 1234
where id_pessoa = 2;

select cvd.id_nota, iv.qtd_item  FROM cad_cliente cct 
JOIN cad_vendas cvd ON (cct.cod_cliente = cvd.cod_cliente)
join itens_venda iv on (iv.id_nota=cvd.id_nota)
join cad_produto cp on (cp.cod_produto=iv.cod_produto);


-- JOIN itens_venda ivd ON (cvd.id_nota = ivd.id_nota);

select sum(cpd.preco_produto*iv.qtd_item) sm from cad_produto cpd
join itens_venda iv on (cpd.cod_produto = iv.cod_produto) where iv.id_nota = 2 group by id_nota;

select * from cad_vendas;

SELECT cvd.id_nota, cct.nome_cliente, cvd.data_venda FROM cad_cliente cct 
    JOIN cad_vendas cvd ON (cct.cod_cliente = cvd.cod_cliente)
    join itens_venda iv on (iv.id_nota=cvd.id_nota);
    
 select * from cad_vendas cv order by 1 desc;
 select * from itens_venda iv  order by 1 desc;
 delete from cad_vendas;
 delete from itens_venda;
 
