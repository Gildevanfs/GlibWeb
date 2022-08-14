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
    $sql = "SELECT cvd.id_nota, cct.nome_cliente, cvd.data_venda FROM cad_cliente cct 
    JOIN cad_vendas cvd ON (cct.cod_cliente = cvd.cod_cliente)";
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
  <title>Consulta Vendas</title>
  <br>
  
</head>


<body>
<div class="formCadUsuario">
        <form class="formUsuario" action="" method="POST">
            <h1 class="tituloPage">Consulta Vendas</h1>   
            <hr>

        <table class="table table-striped" id="consulta_cliente">
        <thead>

            <tr>
            <th scope="col">COD.VENDA</th>
            <th scope="col">CLIENTE</th>
            <th scope="col">VALOR DA COMPRA</th>
            <th scope="col">DATA DA COMPRA</th>
            </tr>

        </thead>

        <tbody>
            <?php

            while ($user_data = mysqli_fetch_assoc($result))

            {

             $sql = "SELECT sum(cpd.preco_produto * iv.qtd_item) sm from cad_produto cpd
             join itens_venda iv on (cpd.cod_produto = iv.cod_produto) 
             where iv.id_nota = ".$user_data['id_nota']." group by id_nota";
             
             $resultV = mysqli_query($conn, $sql);

            //  var_dump($user_data);

            $vl_total = $resultV -> fetch_assoc()['sm'];

            echo "<tr>";
                echo "<td>".$user_data['id_nota']."</td>";
                echo "<td>".$user_data['nome_cliente']."</td>";
                echo "<td>".$vl_total."</td>";
                $user_data['data_venda'] = date('d/m/Y');
                echo "<td>".$user_data['data_venda']."</td>";
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

