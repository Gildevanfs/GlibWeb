<?php
    session_start();

    if (isset($_SESSION['email']) == true)
    {    header('Location:\GLIB\home.php');
        
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="/GLIB/style.css" rel="stylesheet">

    <title>GLIB Sistemas</title>
</head>

<body>
    <div class="contentIndex">

        <div class="boxTopLogin">
            <img src="/GLIB/SRC/glib_sistema_logo.png">
        </div>
        
        <div class="textLoginBox">

            <div class="textLogin">
                <h2>Pronto para começar o seu dia?</h2>
                <h3>Gestão com agilidade!</h3>
            </div>


            <form action ="testeLogin.php" class="contentBoxLogin"  method="POST">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="emailLogin" required>
                    <br>
                    <label for="email">Senha</label>
                    <input type="password" name="senha" id="senhaLogin" required>
                <div>
                    <input type="submit" name="submit_login" id="btn-Login" value="Login">
                </div>
            </form>
        
        </div>
    
    </div>
    
</body>
</html>