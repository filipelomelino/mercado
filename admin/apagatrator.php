<?php
/* Renato Gravino Neto - 20150909
 * Apaga produto
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
$sql = "delete from trator where codigo = :cod; ";


try {
   $live = $conn->prepare($sql);
   $live->bindParam(':cod', $_POST['codigo'], PDO::PARAM_INT);
   $executa = $live->execute();

   if ($executa) {
      $retorno['sucesso'] = true;
   } else {
      $retorno['sucesso'] = false;
      $retorno['msg'] = 'Erro ao apagar ' . $live->errorInfo();
   }
} catch (PDOException $e) {
   echo $e->getMessage();
}

//enviando o retorno
echo json_encode($retorno);  //retorna estrutura
?>