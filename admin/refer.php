<?php 
// configurações gerais Renato Gravino Neto 20150901
class refer {
   public $empresa = 'Mercado Agrícola';
   //public $dbcaminho = 'mysql:host=cpmy0007.servidorwebfacil.com;port=3306;dbname=artemeta_aluminio';
  
  /*-
  db--- mercadoa_mercado
  user- mercadoa_mercado
  pass- 2015safra
  -*/
  public $dbcaminho = 'mysql:host=localhost;dbname=mercadoa_mercado';
  public $dbuser = 'trator';
  public $dbpass = '123';
  public $localimg = './images/produto/';
  public $dirfoto = './img/trator/';
  
}
// definindo padroes
setlocale(LC_ALL, 'ptb', 'portuguese-brazil', 'pt-br', 'bra', 'brazil');
date_default_timezone_set('America/Sao_Paulo');
?>