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

  //ALTERA O REGISTRO DE CLIENTE QUANDO EDITADO

 if (isset($_POST['upd_edit_cliente'])) {
      
      $id = $_POST['id'];
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telefone = $_POST['telefone'];

      print_r($id);
      // print_r($nome);
      // print_r($telefone);
      // print_r($email);
      
      $sqlUpdate = "UPDATE cad_cliente SET nome_cliente = '$nome', email_cliente = '$email', tel_cliente ='$telefone'
      where cod_cliente = '$id' ";
      $result = mysqli_query($conn, $sqlUpdate );

      header('Location: consulta_cliente.php');
    
 }
 
   //ALTERA O REGISTRO DO PRODUTO QUANDO EDITADO

   if (isset($_POST['upd_edit_produto'])) {
      
      $id = $_POST['id'];
      $desc_produto = $_POST['desc_produto'];
      $preco_produto = $_POST['preco_produto'];
      $cod_barras = $_POST['cod_barras'];
      $vida_util = $_POST['vida_util'];

      print_r($id);
      // print_r($nome);
      // print_r($telefone);
      // print_r($email);
      
      $sqlUpdate = "UPDATE cad_produto 
                    SET desc_produto = '$desc_produto', preco_produto = '$preco_produto', cod_barras ='$cod_barras', vida_util ='$vida_util'
                    WHERE cod_produto = '$id' ";
      $result = mysqli_query($conn, $sqlUpdate );

      header('Location: consulta_produto.php');
    
 }


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

     header('Location: GLIB\admin\consulta_usuario.php');
   
}


?>