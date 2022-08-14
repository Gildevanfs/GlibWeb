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

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM cad_cliente WHERE cod_cliente=$id";
        $result = mysqli_query($conn, $sqlSelect);

        // print_r ($result);


    if ($result -> num_rows > 0 ){

    while ($data_cliente = mysqli_fetch_assoc($result)) {

        $nome_cliente = $data_cliente['nome_cliente'];
        $email_cliente = $data_cliente['email_cliente'];
        $tel_cliente = $data_cliente['tel_cliente'];
           
    }   
    
    } else {
        header('Location: consulta_cliente.php');
    }
       
        // $sql = "INSERT INTO cad_cliente (nome_cliente, email_cliente, tel_cliente) values
        //  ('$nome', '$email', '$telefone')";

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/GLIB/cadastro/style_cadastro.css" rel="stylesheet">
  

  <title>Edição de Cliente</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="update_cadastro.php" method="POST">
            <h1 class="tituloPage">Edição de Cliente</h1>
            <hr>

            <?php 
            $sql= "SELECT cod_cliente from cad_cliente WHERE cod_cliente = $id";
            $cod_cliente = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. PRODUTO (<?= $cod_cliente -> fetch_assoc()['cod_cliente']?>):</h5>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo"$nome_cliente" ?>" required>
                    <label for="nome" class="inputLabel">Nome Completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" value="<?php echo"$email_cliente" ?>" required>
                    <label for="email" class="inputLabel">Email</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo"$tel_cliente" ?>" required>
                    <label for="telefone" class="inputLabel">Telefone</label>
                </div>
                <br>
                <div class="botForm">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="upd_edit_cliente" id="submit_green" value="Confirmar">
                <a id="submit_reda" href="consulta_cliente.php"> Cancelar </a>
                </div>

        </form>
    </div>

</body>

</html>