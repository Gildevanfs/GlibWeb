<?php

session_start();
//  print_r($_SESSION);

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['email']) == true))
 {
       unset($_SESSION['email']);
       unset($_SESSION['senha']);

       header('Location:\GLIB\index.php');
 }

    require_once '../conexao.php';

    if (isset($_POST ["submit_green"])) {
        $desc_produto = $_POST['desc_produto'];
        $preco_produto = $_POST['preco_produto'];
        $cod_barras = $_POST['cod_barras'];
        $vida_util =$_POST['vida_util'];
        
        $sql = "INSERT INTO cad_produto (desc_produto, preco_produto, cod_barras, vida_util) values
         ('$desc_produto', '$preco_produto', '$cod_barras','$vida_util')";

        if (mysqli_query($conn, $sql)) {
            echo "Registro cadastrado com sucesso";
        } else {
            echo "Erro no cadastro";
        }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/GLIB/cadastro/style_cadastro.css" rel="stylesheet">

  <title>Cadastro de Produtos</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="" method="POST">
            <h1 class="tituloPage">Cadastro de Produtos</h1>   
            <hr>

            <?php 
            $sql= 'SELECT cod_produto from cad_produto order by cod_produto desc';
            $cod_produto = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. PRODUTO (<?= $cod_produto -> fetch_assoc()['cod_produto']+1?>):</h5>
                <br>
                <div class="inputBox">
                    <input type="text" name="desc_produto" id="desc_produto" class="inputUser" required>
                    <label for="desc_produto" class="inputLabel">Descrição</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" step=0.01 name="preco_produto" id="preco_produto" class="inputUser" required>
                    <label for="preco_produto" class="inputLabel">Preço</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="cod_barras" maxlegnt id="cod_barras" class="inputUser" required>
                    <label for="cod_barras" class="inputLabel">Código de Barras</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="vida_util" id="vida_util" class="inputUser" required>
                    <label for="vida_util" class="inputLabel">Vida Util</label>
                </div>
                <br>
                <div class="botForm">
                <input type="submit" name="submit_green" id="submit_green" value="Confirmar">
                <input type="reset" name="submit_red" id="submit_red" value="Cancelar">
                </div>

        </form>
    </div>

</body>

</html>