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
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $cpf = $_POST['cpf'];
        $sexo = $_POST['sexo'];
        $data_nascimento = $_POST['data_nascimento'];
        
        $sql = "INSERT INTO cad_pessoa (nome, email, login, senha, telefone, cpf, sexo, data_nascimento) 
        values ('$nome', '$email', '$login', '$senha', '$telefone', '$cpf', '$sexo', '$data_nascimento')";

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
  <link href="/GLIB/admin/style_admin.css" rel="stylesheet">

  <title>Cadastro de Usuários</title>
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="" method="POST">
            <h1 class="tituloPage">Cadastro de Usuários</h1>
            <hr>

            <?php 
            $sql= 'SELECT id_pessoa from cad_pessoa order by id_pessoa desc';
            $cod_usuario = mysqli_query($conn, $sql);
            ?>

            <h5>CÓD. USUÁRIO (<?= $cod_usuario -> fetch_assoc()['id_pessoa']+1?>):</h5>
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
                    <input type="text" name="login" id="senha" class="inputUser" required>
                    <label for="login" class="inputLabel">Login</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="inputLabel">Senha</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="inputLabel">Telefone</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="inputLabel">CPF</label>
                </div>
                <br>
    
                <p>Sexo</p>
                <div class="calendario">
                <input type="radio" id="masculino" name="sexo" value="masculino" required>
                <label for="masculino">Masculino</label>
                    
                <input type="radio" id="feminino" name="sexo" value="feminino" required>
                <label for="masculino">Feminino</label>

                <input type="radio" id="outro" name="sexo" value="outro" required>
                <label for="outro">Outro</label>
                <br><br>

                <div class="">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                   
                </div>
                </div>
                <br><br>

                <div class="botForm">
                <input type="submit" name="submit_green" id="submit_green" value="Confirmar">
                <input type="reset" name="submit_red" id="submit_red" value="Cancelar">
                </div>
        </form>
    </div>

</body>

</html>