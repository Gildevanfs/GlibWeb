<?php
 session_start();

  if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
          unset($_SESSION['email']);
          unset($_SESSION['senha']);

          header('Location:index.php');
    }

    $active_login = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="/GLIB/style.css" rel="stylesheet">
      <title>GLIB Sistemas</title>
      <link href="/GLIB/assets/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
      <tbody>
      <div class="contentHome">
          
          <div class="header">

              <div class="imgHeader" >
                  <a href="home.php">
                  <img src="/GLIB/SRC/glib_sistema_logo.png">
                  </a>
              </div>

              <div class="contentHeader">
                <div class="usuLogado">

                  <h5>Usuário:</h5>
                  <h3><?php echo $_SESSION['login'];?></h3>

                </div>

                <div href="" class="btn-logoff">
                  <a href="sairSistema.php" id="submit_white" >Sair</a>
                </div>
          </div>

          </div>

          <tr class="contentBody">

              <!-- MENU LATERAL -->
              <td class="menuLeft">
                  <div class="menuLeft">      
                      <div class="flex-shrink-0 p-3 bg-white">
                          <ul class="list-unstyled ps-0">
                            <!-- ADMIN -->
                            <li class="mb-1">
                              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false"
                              style=" font-weight: 600;">
                                ADMIN
                              </button>
                              <hr class="hr-leftMenu">
                              <div class="collapse" id="account-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                  <li><a onclick="changeSrc('/GLIB/admin/cadastro_usuario.php')" class="link-dark d-inline-flex text-decoration-none rounded">Cadastro Usuário</a></li>
                                  <li><a onclick="changeSrc('/GLIB/admin/consulta_usuario.php')" class="link-dark d-inline-flex text-decoration-none rounded">Consulta Usuário</a></li>
                                  <!-- <li><a onclick="changeSrc('/GLIB/admin/relatorio_vendas.php')" class="link-dark d-inline-flex text-decoration-none rounded">Relatório de Vendas</a></li> -->
                                </ul>
                              </div>
                            </li>
                            <!-- CADASTRO -->
                            <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false" style="
                            font-weight: 600;">
                              CADASTRO
                            </button>
                            <hr class="hr-leftMenu">
                            <div class="collapse" id="dashboard-collapse">
                              <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a onclick="changeSrc('/GLIB/cadastro/cadastro_cliente.php')" class="link-dark d-inline-flex text-decoration-none rounded">Cadastro Cliente</a></li>
                                <li><a onclick="changeSrc('/GLIB/cadastro/consulta_cliente.php')" class="link-dark d-inline-flex text-decoration-none rounded">Consulta Cliente</a></li>
                                <li><a onclick="changeSrc('/GLIB/cadastro/cadastro_produto.php')" class="link-dark d-inline-flex text-decoration-none rounded">Cadastro Produto</a></li>
                                <li><a onclick="changeSrc('/GLIB/cadastro/consulta_produto.php')" class="link-dark d-inline-flex text-decoration-none rounded">Consulta Produto</a></li>
                              </ul>
                            </div>
                          </li>
                              <!-- VENDAS -->
                            <li class="mb-1">
                              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true"style="
                              font-weight: 600;">
                                VENDAS
                              </button>
                              <hr>
                              <div class="collapse show" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                  <!-- <li><a onclick="changeSrc('/GLIB/vendas/cad_orcamento.php')" class="link-dark d-inline-flex text-decoration-none rounded">Orçamento</a></li> -->
                                  <li><a onclick="changeSrc('/GLIB/vendas/pedido_venda.php')" class="link-dark d-inline-flex text-decoration-none rounded">Pedido de Venda</a></li>
                                  <li><a onclick="changeSrc('/GLIB/vendas/consulta_pedido.php')" class="link-dark d-inline-flex text-decoration-none rounded">Consulta Venda</a></li>
                                </ul>
                              </div>
                            </li>
                            <!-- ALMOXARIFADO -->
                            <!-- <li class="mb-1">
                              <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false"
                              style=" font-weight: 600;">
                                ALMOXARIFADO
                              </button>
                              <hr class="hr-leftMenu">
                              <div class="collapse" id="orders-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Baixa de Entrada</a></li>
                                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Baixa de Saida</a></li>
                                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Consulta Baixa</a></li>
                                  <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Saldo Material</a></li>
                                </ul>
                              </div>
                            </li> -->
                            
                          </ul>
                          <div class="footerMenu">
                            <h5>
                              <hr size="3" width="100%" align="center" noshade>
                              <div><b>GLIB</b> SISTEMAS</div>
                              <div><h6><b>V</b> 1.1.3</h6></div>
                            </h5>
                          </div>
                        </div>    
                  </div>
              </td>

              <!-- IFRAME TELAS -->
              <td class="contentRight">
                  <div class="contentBody">
                    <iframe id="iframeId" src="" width="100%" height="100%"></iframe>
                  </div>
              </td>
              
          </tr>
          
      </tbody>

      <script src="/GLIB/assets/dist/js/bootstrap.bundle.min.js"></script>
      <script src="/GLIB/script.js"></script>
      
  </body>

  <script>
    function changeSrc(loc) {
             document.getElementById('iframeId').src = loc;
    }
  </script>

</html>
