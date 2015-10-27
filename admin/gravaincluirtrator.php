<?php

/* Renato Gravino Neto - 20140306
 * Grava novo produto
 * Update 20140402
  --------------------------------------------------------- */
//var_dump($_POST);
//die();

require_once './refer.php';
$refer = new refer;
$retorno = array();
$retorno['sucesso'] = false;
$retorno['msg'] = '';

//conectando
$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');

$sql = "insert into trator (modelo, marca, novo, cor, combustivel, ano, preco, estoque ) values (:modelo, :marca, :novo, :cor, :combustivel, :ano, :preco, :estoque ) ; ";


try {
   $live = $conn->prepare($sql);
   $live->bindParam(':modelo', $_POST['modelo'], PDO::PARAM_STR);
   $live->bindParam(':marca', $_POST['marca'], PDO::PARAM_STR);
   $live->bindParam(':novo',$_POST['novo'], PDO::PARAM_STR);
   $live->bindParam(':cor', $_POST['cor'], PDO::PARAM_STR);
   $live->bindParam(':combustivel', $_POST['combustivel'], PDO::PARAM_STR);
   $live->bindParam(':ano', $_POST['ano'], PDO::PARAM_STR);
   $live->bindParam(':preco', $_POST['preco'], PDO::PARAM_STR);
   $live->bindParam(':estoque', $_POST['estoque'], PDO::PARAM_STR);
   $executa = $live->execute();

   //codigo do insert
   $numero = $conn->lastInsertId();

   if ($executa) {
      $retorno['sucesso'] = true;
      $retorno['gravou']  = 'gravou';
   } else {
      $retorno['sucesso'] = false;
      $retorno['msg'] = 'Erro ao gravar trator ' . $live->errorInfo();
   }
} catch (PDOException $e) {
   echo $e->getMessage();
}

// gravando arquivo
/*
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg')) {
   $retorno['sucesso'] = true;
   $retorno["msg"] = "gravou no caminho" . '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg';
} else {
   $retorno['sucesso'] = false;
   $retorno["msg"] = "Erro ao fazer upload " . '../images/produto/img' . str_pad($numero, 4, '0', STR_PAD_LEFT) . '.jpg';
}
*/
//enviando o retorno
echo json_encode($retorno);  //retorna estrutura
?>