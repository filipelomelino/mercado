<?php
/* Renato Gravino Neto - 20150909
 * Altera trator
 * Update 20150909
  --------------------------------------------------------- */
require_once './refer.php';
$refer = new refer;
$retorno = array();
$retorno['sucesso'] = false;
$retorno['msg'] = 'ainda nem gravou...';

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
?>


  <div class="container">
    <div class="respiro">
      <div class="well">
        <div class="row">
          <div class="span12">

            <form id="formproduto" class="form-horizontal" method="post" onsubmit="return false;" action="" autocomplete="off">
              <h1>Alterando o trator</h1>

              <!-- alerta -->
              <div id="alerta"></div>

              <!-- codigo -->
              <div class="control-group oculto">
                <label class="control-label" for="codigo">Código:</label>
                <div class="controls">
                  <input type="text" class="input-mini desabilitado" id="codigo" readonly name="codigo" maxlength="5" title="Código" value="<?php echo trim($trator['codigo']); ?>" />
                </div>
              </div>
              <!-- Modelo -->
              <div class="control-group">
                <label class="control-label" for="modelo">Modelo:</label>
                <div class="controls">
                  <input type="text" class="input-xxlarge" id="modelo" name="modelo" maxlength="50" title="Modelo do trator" value="<?php echo trim($trator['modelo']); ?>" required placeholder="Modelo do trator..." />
                </div>
              </div>

              <!-- marca -->
              <div class="control-group">
                <label class="control-label" for="marca">Marca:</label>
                <div class="controls">
                  <input type="text" class="input-xxlarge" id="marca" name="marca" maxlength="50" title="Marca do trator" value="<?php echo trim($trator['marca']); ?>" required placeholder="Marca do trator..." />
                </div>
              </div>

              <!-- Novo -->
              <div class="control-group">
                <label class="control-label">Novo:</label>
                <div class="controls form-inline">
                  <input type="radio" name="novo" value="1" id="novot" <?php echo (! $trator[ 'novo'])? '': 'checked';?> />
                  <label for="novot">Novo</label>
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="novo" value="0" id="novof" <?php echo ($trator[ 'novo'])? '': 'checked';?>/>
                  <label for="novof">Usado</label>
                </div>
              </div>

              <!-- Cor -->
              <div class="control-group">
                <label class="control-label" for="cor">Cor:</label>
                <div class="controls">
                  <input type="text" class="input-xxlarge" id="cor" name="cor" maxlength="20" title="Cor do trator" value="<?php echo trim($trator['cor']); ?>" required placeholder="Cor do trator..." />
                </div>
              </div>

              <!-- Combustivel -->
              <div class="control-group">
                <label class="control-label" for="combustivel">Combustível:</label>
                <div class="controls">
                  <input type="text" class="input-xxlarge" id="combustivel" name="combustivel" maxlength="20" title="Combustível do trator" value="<?php echo trim($trator['combustivel']); ?>" required placeholder="Combustível..." />
                </div>
              </div>
              <!-- Ano -->
              <div class="control-group">
                <label class="control-label" for="ano">Ano:</label>
                <div class="controls">
                  <input type="number" class="input-large" id="ano" name="ano" maxlength="4" title="Ano de fabricação" value="<?php echo trim($trator['ano']); ?>" required placeholder="ano..." min='1960' max='<?php echo date("Y"); ?>' />
                </div>
              </div>

              <!-- Preco -->
              <div class="control-group">
                <label class="control-label" for="preco">Preço:</label>
                <div class="controls">
                  <input type="text" class="input-large" id="preco" name="preco" maxlength="12" title="Preço de venda" value="<?php echo trim($trator['preco']); ?>" required placeholder="Preço..." />
                </div>
              </div>

              <!-- estoque -->
              <div class="control-group">
                <label class="control-label">Em estoque:</label>
                <div class="controls form-inline">
                  <input type="radio" name="estoque" value="1" id="estoquet" <?php echo (! $trator[ 'estoque'])? '': 'checked';?> />
                  <label for="estoquet">Sim</label>
                  &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="estoque" value="0" id="estoquef" <?php echo ($trator[ 'estoque'])? '': 'checked';?> />
                  <label for="estoquef">Não</label>
                </div>
              </div>

              <!-- efetua o enviar -->
              <?php
/*-
              <div class="oculto">
                <input type="submit" value="enviar" />
              </div>
-*/
?>
                <div class="btn-group pull-left">
                  <button class="btn btn-primary" onclick="gravaalttrator();
                     return false;"><i class="icon-ok"></i> Salvar</button>
                </div>

                <br class="clear">
            </form>
          </div>
        </div>
        <div class="row">
          <div class="span4">
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/jqmeiomask.js"></script>
  <script src="./js/mudatextotrator.js"></script>