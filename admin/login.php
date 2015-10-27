<?php
// verifica login
require_once('refer.php');
$refer = new refer;
session_start();
if (!isset($_SESSION['tentativa'])) {
   $_SESSION['tentativa'] = 0;
   $erromsg = '';
} else {
   $_SESSION['tentativa']++;
   $erromsg = "Já errou a senha {$_SESSION['tentativa']} vezes";
}
$nick = strtoupper(trim($_POST['nick']));
$passwd = strtoupper(trim($_POST['passwd']));

if (!empty($nick) and !empty($passwd)) {
   $conn = new PDO($refer->dbcaminho, $refer->dbuser, $refer->dbpass) or
           die('Erro ao conectar');
   //executa a instrução de consulta
   $sql = "select * from passwd where upper(nick)='$nick' and upper(passwd)='$passwd';";
   $result = $conn->query($sql) or
           die('falha no sql ' . $sql);

   if ($result->rowCount() == 0) {
      unset($_SESSION['tentativa']);

      $linha = $result->fetch(PDO::FETCH_OBJ);
      $_SESSION['codusuario'] = $linha->codigo;
      $_SESSION['apelido'] = $linha->nick;
      $_SESSION['datalog'] = date('d/m/Y H:i:s');

      $conn = NULL;
      header('Location: principal.php');
      die;
   }
}
?>
  <!DOCTYPE html>
  <html lang="pt-br">

  <head>
    <title>
      <?php echo $empresa ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="expires" content="Fri, May 13 1981 08:20:00 GMT">
    <meta http-equiv="pragma" content="no-cache">
    <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
    <meta name=”robots” content=”noindex,nofollow”>
    <meta name="author" content="Renato Gravino Neto">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <script type="text/javascript" src="./js/jq.js" language="JavaScript"></script>


    <link href="css/login.css" rel="stylesheet">
  </head>

  <body>
    <div id="divlogin">
      <form method="post">
        <small>Digite seus dados para acesso</small>
        <br />
        <p>
          <label for="nick">Usuário:</label>
          <input type="text" name="nick" id="nick" autofocus></input>
          <input type="hidden" name="t" id="t" value="<?php echo $t; ?>">
        </p>
        <p>
          <label for="passwd">Senha:</label>
          <input type="password" name="passwd" id="passwd"></input>
        </p>
        <div id="divmsg">
          <?php echo $erromsg; ?>
        </div>
        <br />
        <input type="submit" value="Entrar">
        <a href="esqueci.php">Esqueci a senha</a>
      </form>
    </div>
  </body>

  </html>