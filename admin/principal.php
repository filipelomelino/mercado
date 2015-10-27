<?php
/* -
 * By Renato Gravino Neto 2014-03-05
 * update by 2014-04-15
 * ------------------------------------------------------------- */
require_once 'refer.php';
$refer = new refer;
session_start();

if ($_SESSION['codusuario'] < 1) {
   header('Location: login.php');
   die;
}
?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <META HTTP-EQUIV="Expires" CONTENT="Fri, May 13 1981 08:20:00 GMT">
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTP-EQUIV="Cache-Control" CONTENT="no-store, no-cache, must-revalidate">
    <meta name=”robots” content=”noindex,nofollow”>
    <meta name="author" content="Renato Gravino Neto">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="portuguese" />
    <meta name="description" content="Arte Metal Alumínio" />
    <link rel="icon" type="image/x-icon" href="./favicon.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title>
      <?php echo $refer->empresa; ?>
    </title>
    <!-- css -->
    <?php //     <link href="css/<?php echo $css; ?  >" rel="stylesheet"> ?>

      <link href="css/bootstrap.teste.css" rel="stylesheet">
      <link href="css/principal.css" rel="stylesheet">
      <link href="cleditor/jquery.cleditor.css" rel="stylesheet">
      <!-- javascript -->
      <script type="text/javascript" src="./js/jq.js" language="JavaScript"></script>
  </head>

  <body>
    <!-- cabecalho -->
    <div id="cabecalho" class="container">
      <div id="carregando"><img src="img/carregando.gif" alt="carregando"></img> Carregando...</div>
      <img src="../images/logo.png" alt="Logomarca" title="<?php echo $refer->empresa ?>">
    </div>

    <!-- Menu -->
    <div class="container">
      <div id="divmenu" class="navbar navbar-static">
        <div class="navbar-inner">
          <div class="container" style="width: auto;">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="#" onclick="letrator();
                                 return false;">Tratores</a>
              </li>
              <?php
  /*---
              <li>
                <a href="#" onclick="lempeca();
                                 return false;">Peças</a>
              </li>
  ---*/ ?>
            </ul>

            <div id="divnome" class=" btn-small pull-right">
              <span class="link" title="<?php echo 'Logou ', $_SESSION['datalog']; ?>">
                     <?php echo $_SESSION['nome']; ?>
                  </span> &nbsp;
              <a href="index.php" class="btn" onclick="return logout();"><i class="icon-off"></i>  Sair</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php /* - fim menu - */ ?>
      <div id="idcorpo" class="container"></div>
      <br />
      <br />
      <br />
      <script type="text/javascript" src="./js/bootstrap.min.js" language="JavaScript"></script>
      <script type="text/javascript" src="./js/principal.js" language="JavaScript"></script>
      <script type="text/javascript" src="./cleditor/jquery.cleditor.min.js" language="JavaScript"></script>
      <script type="text/javascript" language="JavaScript" src="./cleditor/jquery.cleditor.min.js"></script>
      <?php
   /* -
     <script type="text/javascript" language="JavaScript" src="./js/biblioteca.js"></script>
     <script type="text/javascript" language="JavaScript" src="./js/toolform.js"></script>
     <script type="text/javascript" language="JavaScript" src="./js/jqmeiomask.js"></script>
    * - */
   ?>

  </body>

  </html>