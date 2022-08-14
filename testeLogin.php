<?php 
// VALIDAR A SESSÃO

 session_start();
//  print_r($_SESSION);

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
  {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);

        header('Location:index.php');
  }

  $active_login = $_SESSION['email'];


// ESSA TELA VALIDA SE O E-MAIL E SENHA EXISTEM E ARMAZENA PARA A SESSÃO


if (isset($_POST['submit_login']) && !empty($_POST['email']) && !empty($_POST['senha']))

{
    require_once 'conexao.php'; // REQUISITA A INFORMAÇÃO DO BANCO QUE É FEITA VIA TELA conexao.php
    $email = $_POST['email']; // RECEBE O VALOR DO INPUT EMAIL E ARMAZENA
    $senha = $_POST['senha']; // RECEBE O VALOR DO INPUT SENHA E ARMAZENA

    //PROTEÇÃO MYSQL INJECT
    $email_escape = addslashes($email);
    $senha_escape = addslashes($senha);


    // ARMAZENA O SELECT NA VARIAVEL $SQL
    $sql = "SELECT * FROM cad_pessoa WHERE email = '$email_escape' and senha = '$senha_escape'";
    
    // MYSQLI_QUERY FAZ A CONSULTA NO BANCO COM A VARIAVEL $CONN E EXECUTA O SQL COM A VARIAVEL $SQL
    $result = mysqli_query($conn, $sql);

        //SE HOUVER MENOS DE UMA LINHA NA VARIAVEL RESULT (VALOR O BANCO) 
    if (mysqli_num_rows($result)<1){
        
        //DESTROI A SESSÃO

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        

        //RETORNA PRO LOGIN
        header('Location:/GLIB/index.php');

    } else {
        
        $login = $result -> fetch_assoc()['login'];
        

        //ACESSA SESSÃO
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['login'] = $login;


        //ACESSA HOME
        header('Location:/GLIB/home.php');
        
    }

}

?>

