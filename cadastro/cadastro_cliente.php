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
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        
        $sql = "INSERT INTO cad_cliente (nome_cliente, email_cliente, tel_cliente) values
         ('$nome', '$email', '$telefone')";

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
  

  <title>Cadastro de Cliente</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="" method="POST">
            <h1 class="tituloPage">Cadastro de Cliente</h1>
            <hr>

            <?php 
            $sql= 'SELECT cod_cliente from cad_cliente order by cod_cliente desc';
            $cod_cliente = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. CLIENTE (<?= $cod_cliente -> fetch_assoc()['cod_cliente']+1?>):</h5>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="inputLabel">Nome Completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" required>
                    <label for="email" class="inputLabel">Email</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="inputLabel">Telefone</label>
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