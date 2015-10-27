<?php
/* Renato Gravino Neto - 20140306
 * Altera foto
 * Update 20140418
  --------------------------------------------------------- */
$numero = $_POST['codigo'];

var_dump($_POST);
var_dump($_FILES);
// gravando arquivo
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg')) {
   echo   "gravou no caminho" . '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg';
} else {
   echo "Erro ao fazer upload " . '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg';
}
?>