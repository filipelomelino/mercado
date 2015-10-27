<?php
/* Renato Gravino Neto - 20150916
 * Adiciona produto
 * Update 20150918
  --------------------------------------------------------- */
require_once './refer.php';
$refer = new refer;
$vtrimg = array();
$retorno = array();
$retorno['sucesso'] = false;
$retorno['msg'] = 'ainda nem gravou...';
$codigo = $_POST['codigo'];
$dirfoto =  $refer->dirfoto ;

$txtimg  = 'img' . str_pad($codigo, 4, "0", STR_PAD_LEFT);

//conectando
$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');

$sql = "select * from trator where codigo = :cod; ";

try {
   $live = $conn->prepare($sql);
   $live->bindParam(':cod', $_POST['codigo'], PDO::PARAM_INT);
   $executa = $live->execute();

   if ($executa) {
      $retorno['sucesso'] = true;
   } else {
      $retorno['sucesso'] = false;
      $retorno['msg'] = 'Erro ao consultar ' . $live->errorInfo();
   }

   $trator = $live->fetch();
} catch (PDOException $e) {
   echo $e->getMessage();
}

//-------------------------------------
    $d = dir($refer->dirfoto);
//    echo "Handle: " . $d->handle . "\n";
//    echo "Caminho: " . $d->path . "\n";
    while (false !== ($entry = $d->read())) {
//      echo $entry."\n<br />";
      if(substr($entry,0,7)==$txtimg){
        $vtrimg[] = $entry;
      }
    }
    $d->close();
       
sort( $vtrimg );
///--->>>  var_dump($vtrimg);

  ?>

  <div class="container">
    <div class="respiro">
      <form id="incFoto" class="form-horizontal" method="post" action="gravaimagem.php" autocomplete="off" enctype="multipart/form-data">

        <!-- codigo -->
        <div class="control-group oculto">
          <label class="control-label" for="codigo">codigo:</label>
          <div class="controls">
            <input type="text" class="input-mini desabilitado" id="codigo" readonly name="codigo" maxlength="5" title="codigo" value="<?php echo $codigo; ?>" />
          </div>
        </div>
        <br class="clear" />

        <div class="control-group">
          <label class="control-label" for="trator">Foto trator:</label>
          <div class="controls">
            <input type="file" name="arquivo" id="arquivo" class="span6" onchange="escolhearquivo()" />
            <div id="resposta"> </div>
          </div>
        </div>

        <div class="btn-group pull-left">
          <button id="btnIncluirImg" class="btn btn-primary" onclick="incluirfototrator(<?php echo $codigo; ?>);
               return false;"><i class="icon-plus"></i> Adicionar Foto
          </button>
        </div>
        <!-- efetua o enviar -->
        <div class="oculto">
          <input type="submit" value="enviar" />
        </div>
      </form>
      <div class="pull-right oculto" id="divbarraprogresso">
        <div>Aguarde, Enviando o arquivo para o servidor...</div>
        <div class="progress progress-info progress-striped active span4">
          <div id="barraprogresso" class="bar pull-left" style="width: 0%;"></div>
          <span class="margem-esq" id="porcentagem">0%</span> </div>
      </div>
    </div>
  </div>





  <div class="container">
    <div class="respiro">
      <div id="itemnovo" class="well">
        <form id="formitemnovo" class="form-horizontal" method="post" onsubmit="return false;" action="" autocomplete="off">
          <legend>Alterando foto do trator :
            <?php echo $trator['modelo']; ?>
          </legend>
          <?php 
  foreach($vtrimg as $key => $val ){
   ?>
            <div class="row" style="margin-bottom:20px">
              <div class="span4">
                <img src="<?php echo $refer->dirfoto . $val;?>" alt="<?php echo $val; ?>" width="100%" />
              </div>
              <div class="span3">
                <button id="btnDeleteImg" class="btn btn-info" onclick="apagarfototrator(<?php echo $codigo; ?>);
               return false;"><i class="icon-plus"></i> Apagar Foto
                </button>
              </div>
            </div>
            <?php
  }

          die("parou parou parou");
          ?>

              <div class="row">
                <div class="span4">
                  <img src="<?php echo '../', $refer->localimg, 'img', str_pad($trator['codigo'], 4, '0', STR_PAD_LEFT), '.jpg'; ?>" alt="<?php echo $trator['titulo']; ?>" width="270" />
                </div>
                </row>


                <!-- alerta -->
                <div id="alerta"></div>

                <!-- codigo -->
                <div class="control-group oculto">
                  <label class="control-label" for="codigo">codigo:</label>
                  <div class="controls">
                    <input type="text" class="input-mini desabilitado" id="codigo" readonly name="codigo" maxlength="5" title="codigo" value="<?php echo $trator['codigo']; ?>" />
                  </div>
                </div>
                <br class="clear" />

                <!-- trator-->
                <div class="control-group">
                  <label class="control-label" for="trator">trator:</label>
                  <div class="controls">
                    <input type="file" name="arquivo" id="arquivo" class="span6" onchange="escolhearquivo()" />
                    <div id="respostaxx"> </div>
                  </div>
                </div>
                <div class="pull-right oculto" id="divbarraprogresso">
                  <div>Aguarde, Enviando o arquivo para o servidor...</div>
                  <div class="progress progress-info progress-striped active span4">
                    <div id="barraprogresso" class="bar pull-left" style="width: 0%;"></div>
                    <span class="margem-esq" id="porcentagem">0%</span> </div>
                </div>
                <br class="clear" />

                <!-- efetua o enviar -->
                <div class="oculto">
                  <input type="submit" value="enviar" />
                </div>

                <div class="btn-group pull-left">
                  <button id="btnNovatrator" class="btn btn-primary" onclick="return false;"><i class="icon-ok"></i> Salvar trator</button>
                </div>

                <br class="clear">
        </form>
        <br class="clear">
        </div>
      </div>
    </div>

    <br class="clear" />


    <script src="./js/jquery.form.js" type="text/javascript"></script>
    <script src="./js/alteraimagem.js"></script>