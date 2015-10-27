<?php
/* Renato Gravino Neto - 20150916
 * Grava nova imagem
 * Update 20140418
  --------------------------------------------------------- */
require_once './refer.php';
$refer = new refer;
$vtrimg = array();
$retorno = array();
$retorno['sucesso'] = false;
$retorno['msg'] = 'ainda nem gravou...';
$codigo = $_POST['codigo'];

var_dump($_GET);
echo '<hr />';
var_dump($_POST);
echo '<hr />';
var_dump($_FILES);


//conectando
$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');

$sql = "select * from trator where codigo = :cod; ";

?>