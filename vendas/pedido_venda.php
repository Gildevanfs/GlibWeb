<?php 
session_start();

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
 {
       unset($_SESSION['email']);
       unset($_SESSION['senha']);

       header('Location:\GLIB\index.php');
 }

 require_once '../conexao.php';
      if (isset($_GET['action'])){
            if( $_GET['action'] == 'delete'){

                  $deleteItem = addslashes($_GET['cod_item']);

                  $sql = 'DELETE FROM itens_venda WHERE id_venda = '.$deleteItem;
                  $result = mysqli_query($conn, $sql);

                  header('Location: pedido_venda.php?cod='.$_GET['cod_venda']);
            }

      }
      if (isset($_POST['cod_produto'])){
            

      $id_nota = $_POST['cod_venda'];
      $cod_produto = $_POST['cod_produto'];
      $qtd_item = $_POST['qtd_item'];

      //var_dump($_POST);
      //exit;

      $sql = "INSERT INTO itens_venda (id_nota, cod_produto, qtd_item) VALUES ('$id_nota','$cod_produto', '$qtd_item');";
      $result = mysqli_query($conn, $sql);

      header('Location: pedido_venda.php?cod='.$id_nota);

      }

      if (isset($_GET['rpc'])){

            // GET DO CLIENTE
            if ($_GET['rpc'] == 'cliente' ) {

                  // echo 'VALOR EXISTENTE';
                  $cliente = addslashes($_GET['nome']);
                  
                  $sql = 'SELECT cod_cliente, nome_cliente 
                          FROM cad_cliente 
                          WHERE nome_cliente
                          LIKE ("%'.$cliente.'%")';

                  $result = mysqli_query($conn, $sql);

                  if ($result -> num_rows > 0) {
                        
                        $nomeCliente = array();

                        while($resultCliente = $result -> fetch_object()) {

                              // var_dump($resultCliente);
                              $nomeCliente[] = [
                                    'ID' => $resultCliente -> cod_cliente,
                                    'NOME' => $resultCliente -> nome_cliente
                              ];
                        }
                        // var_dump($nomeCliente);
                        echo json_encode($nomeCliente);
                  
                  }

            }

            // GET DO PRODUTO
            if ($_GET['rpc'] == 'produto' ) {

                  // echo 'VALOR EXISTENTE';
                  $produto = addslashes($_GET['produto']);
                  
                  $sql = 'SELECT cod_produto, desc_produto 
                          FROM cad_produto 
                          WHERE desc_produto
                          LIKE ("%'.$produto.'%")';

                  $result = mysqli_query($conn, $sql);

                  if ($result -> num_rows > 0) {
                        
                        $nomeProduto = array();               

                        while($resultProduto = $result -> fetch_object()) {

                              // var_dump($resultCliente);
                              $nomeProduto[] = [
                                    'ID' => $resultProduto -> cod_produto,
                                    'ITEM' => $resultProduto -> desc_produto
                              ];
                        }
                        
                        // var_dump($nomeCliente);
                        echo json_encode($nomeProduto);
                  
                  }

            }

            // GET APAGA VENDA
            if ($_GET['rpc'] == 'apaga_venda'){

            // 1 - SE TIVER ITENS APAGA OS ITENS

            $sqlApIt = "DELETE from itens_venda where id_nota = ".$_GET['cod'];
            $resultApIt = mysqli_query($conn, $sqlApIt);

            // 2 - APAGA NOTA
            
            $sqlApNt = "DELETE from cad_vendas where id_nota = ".$_GET['cod'];
            $resultApNt = mysqli_query($conn, $sqlApNt);

            header('Location: pedido_venda');

            }
            exit;
      }

 ?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/GLIB/vendas/style_vendas.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

  <title>Pedido de Venda</title>
</head>

<body style="margin: 20px;">  
      <h1 class="tituloPage">Pedido de Venda</h1>
      <hr>
      
      <div class="divCabecalho">
            <div class="divFormCliente" >                  
                  <form class="formCliente" action="" method="POST"
                  style="font-size: 15px; font-weight: bold; color: #0090CF;">

                  <h5 style="padding-right: 15px;">NOME CLIENTE: </h5>
                  
                  <?php 
                        
                        if (isset($_POST['cod_cliente']) && !empty($_POST['cod_cliente'])) {
                              print $_POST['nm_cliente'];

                              $date = date('Y-m-d');

                              $cod_cliente = $_POST['cod_cliente'];
                              $sql = "INSERT INTO cad_vendas (data_venda, cod_cliente) VALUES ('$date', '$cod_cliente')";
                              $sqlCliente = "SELECT nome_cliente FROM cad_cliente WHERE cod_cliente = '$cod_cliente';";
                              

                              $result = mysqli_query($conn, $sql);
                              $id_result = mysqli_insert_id($conn);

                              header('Location: pedido_venda.php?cod='.$id_result);

                        } else {

                              if (isset($_GET['cod']))
                              {
                                    $sqlVenda = 'SELECT * FROM cad_vendas cv
                                    JOIN cad_cliente cc ON (cv.cod_cliente = cc.cod_cliente) 
                                    WHERE cv.id_nota =' . $_GET['cod'];

                                    $result = mysqli_query($conn, $sqlVenda);
                                    $resultVendas = mysqli_fetch_assoc($result);

                                    // var_dump($resultVendas);
                                    echo $resultVendas['nome_cliente'];

                              } else {

                  ?>

                  <!-- DIVE DE INCLUSÃO DO CLIENTE -->

                  <div class=" ui fluid category search form-group" style= "display: flex; width: 50%;">
                        <label for="role_name">
                        <span class="text-danger">*</span> </label>
                        <input style="margin: 5px 15px;border-radius: 4px !important; " class="form-control prompt" id="pessoa" placeholder="Nome Pessoa" name="nm_cliente" type="text" value="" autocomplete="off" required>
                        <div class="results">

                  </div>   
                  
                  <input type="hidden" id="id" name="cod_cliente">
            
                  <button class = 'btn btn-sm btn-success' style="padding: 10px;" href=''> 
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                   <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                        </svg> 
                  </button>

            </div> 
      </div>

      <?php }
      $vd_total = 0;
      } ?>

      </form>
            <hr>
            
      <?php 
            if(isset($_GET['cod']) && !empty($_GET['cod'])){             
      ?>


      <form class="formItem" action="" method="POST">
      
      <input type="hidden" id="" name="cod_venda" value="<?= $_GET['cod'] ?>">
            
            <!-- DIVE DE INCLUSÃO DOS PRODUTOS -->

      <h2> Incluir Itens </h2>

            <!-- INCLUI OS ITENS -->
            <div class="divFormItem" >                  
                  
            <div class="divVendasNome ui search" style=" display: flex; width: 600px; align-items: center;">
                  <label for="cod_produto" class="inputLabel">DESCRIÇÃO: </label>
                  <input style="margin: 5px 15px; border-radius: 4px !important; border-color: #00569F;" class="form-control prompt" id="pessoa" placeholder="Produto" name="ds_produto" type="text" value="" autocomplete="off" required >
                  <div class="results"> </div>
            </div>

            <input type="hidden" id="id_produto" name="cod_produto">

            <div class="divVendasQtd" >
                  <label for="cod_produto" class="inputLabel">QUANTIDADE: </label>
                  <input type="number" class="inputUser" id="codCliente" name="qtd_item" style=" padding-top: 19px; padding-bottom: 19px;"  placeholder="Qtd" required >
            </div>
                                  
            <div class="divBtn">
                  
                   <button class = 'btn btn-sm btn-success' style="padding: 10px;" href=''> 
                   <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                   <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                   </svg>
                  </button>  
                  
            </div>  

                  </form>
            </div>
       
      </div>


            <!--  TABELA DOS ITENS-->
      
      <div class="formCadVenda">

        <form class="formUsuario" action="" method="POST">
            <h4 class="tituloPage">Itens do pedido</h4>   
            <hr>


        <table class="table table-striped" id="consulta_cliente">

        <thead>

            <tr>
            <th scope="col">CÓD.</th>
            <th scope="col">ITEM</th>
            <th scope="col">VALOR (R$)</th>
            <th scope="col">QUANTIDADE</th>
            <th scope="col">TOTAL</th>
            <th scope="col">...</th>
            </tr>

        </thead>
        
        <tbody>
          <?php 
            
              $id_nota = $_GET['cod'];
              
              $sql = ('SELECT cp.cod_produto, cp.desc_produto, cp.preco_produto, ivd.qtd_item, ivd.id_venda
              FROM cad_vendas cvd
              JOIN itens_venda ivd ON (cvd.id_nota = ivd.id_nota)
              JOIN cad_produto cp ON (cp.cod_produto = ivd.cod_produto)
              WHERE cvd.id_nota = '.$id_nota.';');
              $result = mysqli_query($conn, $sql);
            
              while ($user_data = mysqli_fetch_assoc($result)) {
                  
            
            echo "<tr>";
                  echo "<td>".$user_data['cod_produto']."</td>";
                  echo "<td style='width: 400px;'>".$user_data['desc_produto']."</td>";
                  echo "<td>"."R$ ".$user_data['preco_produto']."</td>";
                  echo "<td>".$user_data['qtd_item']." und</td>";

                  $vl_total = $user_data['preco_produto'] * $user_data['qtd_item'];
                  
                  echo "<td>"."R$ ".$vl_total."</td>";
                  echo "<td> 

                              <a class='btn btn-sm btn-danger' 
                              href='pedido_venda.php?action=delete&cod_item=".$user_data['id_venda']."&cod_venda=".$id_nota."'> 
                              <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
                              <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
                              </svg>
                              </a> 
                    
                        </td>";

           
                        echo "</tr>";

            $vd_total = $vd_total + $vl_total;

      ?>

            <?php } ?>

            </tbody>
            </div>

      </table>

      <?php echo "<h3 style='padding-top: 100px;'>"." Valor total: R$ ".$vd_total."</h3>";?>

      <div class="btConfirm">
            <a class = 'btn btn-sm btn-danger' style="padding: 10px;" href='pedido_venda.php?rpc=apaga_venda&cod=<?= $_GET['cod']?>'> Cancelar Venda </a> 
            <a class = 'btn btn-sm btn-success' style="padding: 10px;" href='pedido_venda.php'> Finalizar Venda </a>   
      </div> 
       

      <?php } ?>

             <!--  JAVASCRIPT-->


      <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
      
      <script> //SCRIPT DO CLIENTE
            $(document).ready(function($) {
                  $('.ui.search')
            .search({
                apiSettings: {
                    url:'<?=$_SERVER['PHP_SELF'] ?>?rpc=cliente&nome={query}',

                    onResponse: function(results) {
                        console.log(results)
                        var response = {
                            results: []
                        };
                        $.each(results, function(index, item) {
                            response.results.push({
                                title: item['NOME'],
                                description: item['ID'] + ' - ' + item['NOME'],
                            });
                        });
                        return response;
                    }, 
                },
                onSelect: function(result, response) {
                    cod_pessoa = result.description.split(' - ')[0];
                    $('#id').val(cod_pessoa);
                },
                minCharacters: 3,
            });
            })



      </script>

      <script> // SCRIPT DO MATERIAL
                  $(document).ready(function($) {
                        $('.divVendasNome')
                  .search({
                  apiSettings: {
                        url:'<?=$_SERVER['PHP_SELF'] ?>?rpc=produto&produto={query}',

                        onResponse: function(results) {
                              console.log(results)
                              var response = {
                              results: []
                              };
                              $.each(results, function(index, item) {
                              response.results.push({
                                    title: item['ITEM'],
                                    description: item['ID'] + ' - ' + item['ITEM'],
                              });
                              });
                              return response;
                        }, 
                  },
                  onSelect: function(result, response) {
                        cod_produto = result.description.split(' - ')[0];
                        $('#id_produto').val(cod_produto);
                  },
                  minCharacters: 3,
                  });
                  })



            </script>


      </body>

</html>



