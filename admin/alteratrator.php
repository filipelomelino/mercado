<?php

/* Renato Gravino Neto - 20150909
 * Grava Trator
 * Update 20150909
  --------------------------------------------------------- */
require_once './refer.php';
$refer = new refer;

//conectando
$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');
$sql = 'update trator set modelo = :modelo, marca = :marca, novo = :novo,
cor = :cor, combustivel = :combustivel, ano = :ano, preco = :preco, estoque = :estoque
where codigo = :codigo ; ';
try {
   $live = $conn->prepare($sql);
   $live->bindParam(':codigo', $_POST['codigo'], PDO::PARAM_INT);
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
      echo 'Gravou' ; 
   } else {
      echo 'erro ao gravar';
      }
} catch (PDOException $e) {
   echo $e->getMessage();
}
echo '<center><h2>Salvo com sucesso!!!</h2></center>';
?>