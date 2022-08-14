<?php

session_start();
//  print_r($_SESSION);

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
 {
       unset($_SESSION['email']);
       unset($_SESSION['senha']);

       header('Location:\GLIB\index.php');
 }
    //CONEXÃO COM BANCO
    require_once '../conexao.php';
    //SELECAO DOS DADOS DO BANCO
    $sql = "SELECT * FROM cad_cliente ORDER BY cod_cliente DESC;";
    //RESULTADO ONDE A MYSQLI_QUERY SE CONECTA NO BANCO COM A CONN E DO SQL RECEBENDO O SELECT
    $result = mysqli_query($conn, $sql);

//  print_r($result);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/GLIB/cadastro/style_cadastro.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <title>Consulta Clientes</title>
  <br>
  
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="" method="POST">
            <h1 class="tituloPage">Consulta de Clientes</h1>   
            <hr>

        <table class="table table-striped" id="consulta_cliente">
        <thead>

            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Telefone</th>
            <th scope="col">...</th>
            </tr>

        </thead>

        <tbody>
            <?php

            while ($user_data = mysqli_fetch_assoc($result))
            {
            echo "<tr>";
            echo "<td>".$user_data['cod_cliente']."</td>";
            echo "<td>".$user_data['nome_cliente']."</td>";
            echo "<td>".$user_data['email_cliente']."</td>";
            echo "<td>".$user_data['tel_cliente']."</td>";
            echo "<td> 
            <a class = 'btn btn-sm btn-outline-secondary' 
            href='edita_cliente.php?id=$user_data[cod_cliente]' //ENVIA PARA A TELA DE EDITA CLIENTE O ID - COD_CLIENTE.
            >
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
            <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
            </svg> 
            </a>   

            <a class='btn btn-sm btn-outline-danger' href='delete_cliente.php?id=$user_data[cod_cliente]'> 
            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
            </svg>
            </a> 
            
            </td>" ;


        echo "</tr>";

             }
             
             ?>
        </tbody>
        </table>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>

    <script>
        $(document).ready( function () {
        $('#consulta_cliente').DataTable(
            { 
            "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                }
            }
        ); 
        } );
    </script>    
          
</body>

</html>

