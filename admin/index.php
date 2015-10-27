<?php

/* Índice principal - \o/
 * Seleciona se esta logado
 * dev by Renato Gravino Neto
 * 2015-09-01  
 * update : 2015-09-01
 * ************************************- */

session_start();
//verifica se tem o código de um usuário
if ($_SESSION['codusuario'] < 1) {
   header('Location: login.php');
} else {
   header('Location: principal.php');
}
?>