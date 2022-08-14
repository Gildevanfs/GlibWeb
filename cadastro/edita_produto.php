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

    if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM cad_produto WHERE cod_produto = $id";
        $result = mysqli_query($conn, $sqlSelect);
    
     
    if ($result -> num_rows > 0 ){

        while ($data_produto = mysqli_fetch_assoc($result)){

            $desc_produto = $data_produto['desc_produto'];
            $preco_produto = $data_produto['preco_produto'];
            $cod_barras = $data_produto['cod_barras'];
            $vida_util = $data_produto['vida_util'];

        } 
        
        } else {

            header('Location: consulta_produto.php');
  
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

  <title>Edição de Produto</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="update_cadastro.php" method="POST">
            <h1 class="tituloPage">Edição de Produto</h1>   
            <hr>

            <?php 
            $sql= "SELECT cod_produto from cad_produto WHERE cod_produto = $id";
            $cod_produto = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. PRODUTO (<?= $cod_produto -> fetch_assoc()['cod_produto']?>):</h5>
                <br>
                <div class="inputBox">
                    <input type="text" name="desc_produto" id="desc_produto" class="inputUser" value="<?php echo"$desc_produto"?>" required>
                    <label for="desc_produto" class="inputLabel">Descrição</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" step=0.01 name="preco_produto" id="preco_produto" class="inputUser" value="<?php echo"$preco_produto"?>" required>
                    <label for="preco_produto" class="inputLabel">Preço</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="cod_barras" maxlegnt id="cod_barras" class="inputUser" value="<?php echo"$cod_barras"?>" required>
                    <label for="cod_barras" class="inputLabel">Código de Barras</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="number" name="vida_util" id="vida_util" class="inputUser" value="<?php echo"$vida_util"?>" required>
                    <label for="vida_util" class="inputLabel">Vida Util</label>
                </div>
                <br>
                <div class="botForm">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="upd_edit_produto" id="submit_green" value="Confirmar">
                <a id="submit_reda" href="consulta_produto.php"> Cancelar </a>
                </div>

        </form>
    </div>

</body>

</html>