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

//ALTERA O REGISTRO DO USUÁRIO QUANDO EDITADO

if (isset($_POST['upd_edit_usuario'])) {
      
     $id = $_POST['id'];
     $nome = $_POST['nome'];
     $email = $_POST['email'];
     $senha = $_POST['senha'];

     print_r($id);
     // print_r($nome);
     // print_r($telefone);
     // print_r($email);
     
     $sqlUpdate = "UPDATE cad_pessoa 
                   SET nome = '$nome', email = '$email', senha ='$senha'
                   WHERE id_pessoa = '$id' ";
     $result = mysqli_query($conn, $sqlUpdate );

     header('Location: consulta_usuario.php');
   
}


?>