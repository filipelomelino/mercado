<?php
/* Renato Gravino Neto - 20150903
 * Efetua a leitura do trator
 * Update 
  --------------------------------------------------------- */

require_once './refer.php';
$refer = new refer;

$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');
?>

  <div class="container">
    <div class="respiro">
      <div class="btn-group pull-left">
        <button class="btn btn-primary" onclick="incluirtrator();
               return false;"><i class="icon-plus"></i> Adicionar Trator
        </button>
      </div>

    </div>
  </div>

  <?php
/* --
 * Pegando as imagens
  ---------------------------------------------- */
$sql = "select * from trator order by modelo ;";

$live = $conn->prepare($sql) or
        die('erro no prepare');
// chamada
$live->execute() or
        die('Execute');

$quantos = $live->rowCount();

if ($quantos < 1) {
  ?>
    <script src="js/jquery.form.js" type="text/javascript"></script>
    <script src="./js/editatrator.js"></script>
    <?php
   die('Sem tratores cadastrados!!!!');
}


for ($quebra = 0; $quebra < $quantos; $quebra++) {
   $trator = $live->fetch();
   // exibindo a foto com descricao  
   ?>

      <div class="container">
        <div class="respiro">
          <div class="well">
            <div class="row">

              <?php
  /*----
            <div class="span4">
              <img src="<?php echo '../', $refer->localimg, 'img', str_pad($foto['codigo'], 4, '0', STR_PAD_LEFT), '.jpg'; ?>" alt="
                <?php echo $trator['modelo']; ?>" width="270" />
            </div>
            --- */ ?>

            <div class="span5">
              <table class="table table-striped table-hover">
                <tr>
                  <td>Modelo</td>
                  <td>
                    <?php echo $trator['modelo'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Marca</td>
                  <td>
                    <?php echo $trator['marca'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Novo</td>
                  <td>
                    <?php echo ( (0+ $trator['novo'])==0)?'Não':'Sim';  ?>
                  </td>
                </tr>
                <tr>
                  <td>Cor</td>
                  <td>
                    <?php echo $trator['cor'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Combustível</td>
                  <td>
                    <?php echo $trator['combustivel'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Ano</td>
                  <td>
                    <?php echo $trator['ano'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Preço</td>
                  <td>
                    <?php echo $trator['preco'];  ?>
                  </td>
                </tr>
                <tr>
                  <td>Estoque</td>
                  <td>
                    <?php echo ( (0 + $trator['estoque']) == 0) ?' Não' : 'Sim' ;  ?>
                  </td>
                </tr>
              </table>
            </div>
            <div class="span4">
              <p>
                <button class="btn" type="button" onclick="mudaimagem(<?php echo $trator['codigo'] ;?>);">
                  <i class='icon-picture'></i> &nbsp; Alterar foto
                </button>
              </p>
              <p>
                <button class="btn" type="button" onclick="mudatexto(<?php echo $trator['codigo'] ;?>);">
                  <i class='icon-text-width'></i> &nbsp; Alterar texto
                </button>
              </p>
              <p>
                <button class="btn" type="button" onclick="apagatrator(<?php echo $trator['codigo'] ;?>);">
                  <i class='icon-ban-circle'></i> &nbsp; Apagar
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
        <script src="./js/editatrator.js"></script>