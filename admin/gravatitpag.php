<?php
/* Renato Gravino Neto - 20140306
 * Efetua a leitura do produto
 * Update 20140402
  --------------------------------------------------------- */
require_once './refer.php';
$refer = new refer;

//conectando
$conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
        die('erro ao conectar....');
$sql = "update pagina set titulo= :tit ,subtitulo = :subtit ,descricao = '{$_POST['descricao']}' where codigo= :cod ; ";

try{
       $live = $conn->prepare( $sql );
       $live->bindParam(':tit', $_POST['titulo'] , PDO::PARAM_STR);
       $live->bindParam(':subtit', $_POST['subtitulo'] , PDO::PARAM_STR);
  //     $live->bindParam(3, $_POST['descricao'] , PDO::PARAM_STR);
       $live->bindParam(':cod', $_POST['codigo'], PDO::PARAM_INT);
       $executa = $live->execute() ;
 
       if($executa){
           echo 'Dados alterados com sucesso';
       }
       else{
           echo 'Erro ao alterar os dados <hr>';
           print_r($live->errorInfo());
       }
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }