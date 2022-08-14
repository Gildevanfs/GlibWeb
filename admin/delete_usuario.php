<?php

session_start();
//  print_r($_SESSION);

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
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
    

    if ($result -> num_rows > 0 )
    {

        $sqlDelete = "DELETE FROM cad_pessoa WHERE id_pessoa = $id";    
        $resultDelete = mysqli_query($conn, $sqlDelete);
  
    }

    header('Location: consulta_usuario.php');

}