<?php
/* Renato Gravino Neto - 20150908
 * Adiciona produto
 * Update 20150901
  --------------------------------------------------------- */
?>
  <div class="container">
    <div class="respiro">
      <div id="itemnovo" class="well">

        <form id="formitemnovo" class="form-horizontal" method="post" onsubmit="return false;" action="" autocomplete="off">
          <legend>Adicionar Trator</legend>

          <!-- alerta -->
          <div id="alerta"></div>

          <!-- Modelo -->
          <div class="control-group">
            <label class="control-label" for="modelo">Modelo:</label>
            <div class="controls">
              <input type="text" class="input-xxlarge" id="modelo" name="modelo" maxlength="50" title="Modelo do trator" value="" required autofocus placeholder="Modelo do trator..." />
            </div>
          </div>
          <!-- marca -->
          <div class="control-group">
            <label class="control-label" for="marca">Marca:</label>
            <div class="controls">
              <input type="text" class="input-xxlarge" id="marca" name="marca" maxlength="50" title="Marca do trator" value="" required placeholder="Marca do trator..." />
            </div>
          </div>
          <!-- Novo -->
          <div class="control-group">
            <label class="control-label">Novo:</label>
            <div class="controls form-inline">
              <input type="radio" name="novo" value="1" id="novot" />
              <label for="novot">Novo</label>
              &nbsp;&nbsp;&nbsp;
              <input type="radio" name="novo" value="0" id="novof" />
              <label for="novof">Usado</label>
            </div>
          </div>

          <!-- Cor -->
          <div class="control-group">
            <label class="control-label" for="cor">Cor:</label>
            <div class="controls">
              <input type="text" class="input-xxlarge" id="cor" name="cor" maxlength="20" title="Cor do trator" value="" required placeholder="Cor do trator..." />
            </div>
          </div>

          <!-- Combustivel -->
          <div class="control-group">
            <label class="control-label" for="combustivel">Combustível:</label>
            <div class="controls">
              <input type="text" class="input-xxlarge" id="combustivel" name="combustivel" maxlength="20" title="Combustível do trator" value="" required placeholder="Combustível..." />
            </div>
          </div>

          <!-- Ano -->
          <div class="control-group">
            <label class="control-label" for="ano">Ano:</label>
            <div class="controls">
              <input type="number" class="input-large" id="ano" name="ano" maxlength="4" title="Ano de fabricação" value="" required placeholder="ano..." min='1960' max='<?php echo date("Y"); ?>' />
            </div>
          </div>

          <!-- Preco -->
          <div class="control-group">
            <label class="control-label" for="preco">Preço:</label>
            <div class="controls">
              <input type="text" class="input-large" id="preco" name="preco" maxlength="12" title="Preço de venda" value="" required placeholder="Preco..." />
            </div>
          </div>

          <!-- estoque -->
          <div class="control-group">
            <label class="control-label">Em estoque:</label>
            <div class="controls form-inline">
              <input type="radio" name="estoque" value="1" id="estoquet" />
              <label for="estoquet">Sim</label>
              &nbsp;&nbsp;&nbsp;
              <input type="radio" name="estoque" value="0" id="estoquef" />
              <label for="estoquef">Não</label>
            </div>
          </div>


          <br class="clear" />

          <!-- efetua o enviar -->
          <div class="oculto">
            <input type="submit" value="enviar" />
          </div>
          <div class="respiro"></div>
          <div class="btn-group pull-left">
            <button id="btnNovafoto" class="btn btn-primary" onclick="return false;"><i class="icon-plus"></i> Salvar novo trator</button>
          </div>

          <br class="clear">
        </form>
        <br class="clear">
      </div>
    </div>
  </div>

  <br class="clear" />


  <script src="./js/jquery.form.js" type="text/javascript"></script>
  <script src="./js/jqmeiomask.js"></script>
  <script src="./js/incluirtrator.js"></script>