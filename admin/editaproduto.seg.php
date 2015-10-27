<?php
/* Renato Gravino Neto - 20140408
 * Efetua a leitura do produto
 * Update 20140408
  --------------------------------------------------------- */

require_once './refer.php';
$refer = new refer;

$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');
//pesquisando

$sql = "select * from pagina where chave = '{$_GET['i']}' ;";

$live = $conn->prepare($sql) or
        die('erro no prepare');
// chamada
$live->execute() or
        die('Execute');

if ($live->rowCount() != 1) {
   die('isso non exciste');
}
$produto = $live->fetch();
?>

<div class="container">
   <div class="respiro">
      <div id="formpagina" class="well">

         <form id="formcliente" class="form-horizontal" method="post" onsubmit="gravapagina();
               return false;" action="" autocomplete="off">
            <legend>Cabecalho da pagina <?php echo trim($produto['chave']); ?></legend>

            <!-- alerta -->
            <div id="alerta"></div>

            <!-- codigo -->
            <div class="control-group oculto">
               <label class="control-label" for="codigo">Código:</label>
               <div class="controls">
                  <input type="text" class="input-mini desabilitado" id="codigo" readonly name="codigo"  maxlength="5" title="Código"  value="<?php echo trim($produto['codigo']); ?>" />
               </div>
            </div>

            <!-- titulo -->
            <div class="control-group">
               <label class="control-label" for="titulo">Título:</label>
               <div class="controls">
                  <input type="text"  autofocus class="input-xxlarge" id="titulo" name="titulo"  maxlength="50" title="Titulo principal"  value="<?php echo trim($produto['titulo']); ?>" placeholder="Título..."  />
               </div>
            </div>

            <!-- subtitulo -->
            <div class="control-group">
               <label class="control-label" for="subtitulo">Subtítulo:</label>
               <div class="controls">
                  <input type="text"  class="input-xxlarge" id="subtitulo" name="subtitulo"  maxlength="50" title="Nome completo do cliente"  value="<?php echo trim($produto['subtitulo']); ?>" placeholder="Subtítulo..." />
               </div>
            </div>

            <!-- descricao -->
            <div class="control-group">
               <label class="control-label" for="descricao">Descrição:</label>
               <div class="controls">
                  <textarea name="descricao" id="descricao"><?php echo trim($produto['descricao']); ?></textarea>
               </div>
            </div>

            <!-- efetua o enviar -->
            <div class="oculto">
               <input type="submit" value="enviar" />
            </div>

            <div class="btn-group pull-left">
               <button class="btn btn-primary" onclick="gravapagina();
               return false;"><i class="icon-ok"></i> Salvar</button>
            </div>

            <br class="clear">
         </form>
         <br class="clear">
      </div>
   </div>
</div>

<!-- Fim Cabeca -->

<div class="container">
   <div class="respiro">
      <div class="btn-group pull-left">
         <button class="btn btn-primary" onclick="incluirfoto('<?php echo trim($produto['chave']); ?>');
               return false;"><i class="icon-plus"></i> Adicionar produto em <?php echo trim($produto['chave']); ?></button>
      </div>

   </div>
</div>

<?php
/* --
 * Pegando as imagens
  ---------------------------------------------- */
$sql = "select * from foto where chave = '{$_GET['i']}' order by titulo ;";

$live = $conn->prepare($sql) or
        die('erro no prepare');
// chamada
$live->execute() or
        die('Execute');

$quantos = $live->rowCount();

if ($quantos < 1) {
   die('SEM FOTOS!!!!');
}


for ($quebra = 0; $quebra < $quantos; $quebra++) {
   $foto = $live->fetch();
   // exibindo a foto com descricao  
   ?>   

   <div class="container">
      <div class="respiro">
         <div class="well">
            <div class="row">
               <div class="span4">
                  <img src="<?php echo '../', $refer->localimg, 'img', str_pad($foto['codigo'], 4, '0', STR_PAD_LEFT), '.jpg'; ?>" alt="<?php echo $foto['titulo']; ?>" width="270" />
               </div>
               <div class="span5">
                  <h2><?php echo $foto['titulo']; ?></h2>
                  <p>
                     <?php echo $foto['descricao']; ?>
                  </p>

               </div>
               <div class="span2">
                  <p>
                     <button class="btn" type="button" onclick="mudaimagem(<?php echo $foto['codigo'] ;?> );">
                        <i class='icon-picture'></i> . Alterar foto
                     </button>
                  </p>
                  <p>
                     <button class="btn" type="button" onclick="mudatexto(<?php echo $foto['codigo'] ;?> );">
                        <i class='icon-text-width'></i> . Alterar texto
                     </button>
                  </p>
                  <p>
                     <button class="btn" type="button" onclick="apagaproduto(<?php echo $foto['codigo'] ;?> );">
                        <i class='icon-ban-circle'></i> . Apagar
                     </button>
                  </p>

               </div>
            </div>
         </div>
      </div>
   </div>


   <?php
// final do while
}
?>               
<div class="clr"></div>
</div>

<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="./js/editaproduto.js"></script>
