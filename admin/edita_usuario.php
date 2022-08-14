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
        $sqlSelect = "SELECT * FROM cad_pessoa WHERE id_pessoa = $id";
        $result = mysqli_query($conn, $sqlSelect);
    
     
    if ($result -> num_rows > 0 ){

        while ($data_usuario = mysqli_fetch_assoc($result)){

            $nome = $data_usuario['nome'];
            $email = $data_usuario['email'];
            
        } 
        
        } else {

            header('Location: consulta_usuario.php');
  
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

  <title>Editar Usuário</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="update_usuario.php" method="POST">
            <h1 class="tituloPage">Editar Usuários</h1>
            <hr>

            <?php 
            $sql= "SELECT id_pessoa from cad_pessoa where id_pessoa = $id";
            $cod_usuario = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. USUÁRIO (<?= $cod_usuario -> fetch_assoc()['id_pessoa']?>):</h5>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo"$nome"?>" required>
                    <label for="nome" class="inputLabel">Nome Completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="email" name="email" id="email" class="inputUser" value="<?php echo"$email"?>" required>
                    <label for="email" class="inputLabel">Email</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" value="" required>
                    <label for="senha" class="inputLabel">Senha</label>
                </div>
                <br>
                </div>
                <br><br>

                <div class="botForm">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="upd_edit_usuario" id="submit_green" value="Confirmar">
                <a id="submit_reda" href="consulta_usuario.php"> Cancelar </a>
                </div>

        </form>
    </div>

</body>

</html>