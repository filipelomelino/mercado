<?php
// incluir no banco de dados
function JSincluir($caminho, $post, $tabela)
{
    if (is_file('../refer.php')) {
        include '../refer.php';
        include_once('../biblioteca.php');
    } else {
        include './refer.php';
        include_once('./biblioteca.php');
    }
    $campo = '';
    $valor = '';
    $teste = simplexml_load_file($caminho);
    $tam = sizeof($teste->campo);
    $txt = '';
    for ($x = 0; $x < $tam; $x++) {
        $txt = trim($teste->campo[$x]->db[0]);
        if ($txt == 'codigo') { // nao incluir campo codigo
            continue;
        }
        if (array_key_exists($txt, $post)) {
            $tmp = trim($post[$txt]);
        } else {
            $tmp = '';
            continue;
        }
        switch (strtoupper($teste->campo[$x]->tipo)) {
            case 'C': //caracter
            case 'S': //select fica igual string
            case 'R': // botoes de radio
            case 'X': //checkbox     (xekbox)
                if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                    if (strlen($tmp) < 1) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'T': //textarea
                if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                    if (strlen($tmp) < 1) {
                        die($teste->campo[$x]->erro);
                    }
                }
                $tmp = textarea2string($tmp);
                break;
            case 'D': // data
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    list($ano, $mes, $dia) = explode('-', $tmp);
                    if (!checkdate($mes, $dia, $ano)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'N': //numerico
                $tmp = str_replace(',', '.', $tmp);
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    if (!is_numeric($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'CPF': //verifica CPF
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    if (!cpf($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'CNPJ': //verifica CNPJ
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    if (!cnpj($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            default:
                die('desconhecido');
        }

        //aqui entra o campo
        if (strlen($tmp) > 0) {
            $campo .= ", " . $txt;
            //$tmp = maiusculo($tmp);
            if (strtoupper($teste->campo[$x]->tipo) == 'D' and empty($tmp)) {
                $valor .= ", null";
            } else {
                $valor .= ", '$tmp'";
            }
        }
    }

    $campo = substr($campo, 1);
    $valor = substr($valor, 1);

    $sql = "insert into $tabela ($campo) values ($valor);";
    $conn = pg_connect($conectar) or
            die("N&atilde;o efetuou conex&atilde;o com $host");

    $resultado = pg_query($conn, $sql);
    if (!$resultado) {
        $bug = pg_result_error($conn);
        pg_close($conn);
               die("Falha ao gravar sql (toolform)");
    }
    pg_free_result($resultado);
    pg_close($conn);
// echo 'Sucesso ao gravar inclusão! ';
}

//-------------------------------------------------
// alterar
function JSalterar($caminho, $post, $tabela, $chave="")
{
    if (is_file('../refer.php')) {
        include '../refer.php';
        include_once('../biblioteca.php');
    } else {
        include './refer.php';
        include_once('./biblioteca.php');
    }
    if (empty($chave)) {
        $chave = "codigo={$post['codigo']}";
    }
    $campo = '';
    $teste = simplexml_load_file($caminho);
    $tam = sizeof($teste->campo);
    $txt = '';
    for ($x = 0; $x < $tam; $x++) {
        $txt = trim($teste->campo[$x]->db[0]);
        if (array_key_exists($txt, $post)) {
            $tmp = trim($post[$txt]);
        } else {
            $tmp = '';
            continue;
        }
        if (strtoupper($txt) == 'CODIGO') {
            continue;
        }
        switch (strtoupper($teste->campo[$x]->tipo)) {
            case 'C': //caracter
            case 'S': //select fica igual string
            case 'R': // botoes de radio
            case 'X': //checkbox     (xekbox)
                if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                    if (strlen($tmp) < 1) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'T': //TextArea tambem
                if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                    if (strlen($tmp) < 1) {
                        die($teste->campo[$x]->erro);
                    }
                }
                $tmp = textarea2string($tmp);
                break;
            case 'D': // data
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    list($ano, $mes, $dia) = explode('-', $tmp);
                    if (!checkdate($mes, $dia, $ano)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'N': //numerico
                $tmp = str_replace(',', '.', $tmp);
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    } else {
                        $tmp = 0;
                    }
                } else {
                    if (!is_numeric($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'CPF': //verifica CPF
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    if (!cpf($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            case 'CNPJ': //verifica CNPJ
                if (empty($tmp)) {
                    if (strtoupper($teste->campo[$x]->obrigatorio) == 'S') {
                        die($teste->campo[$x]->erro);
                    }
                } else {
                    if (!cnpj($tmp)) {
                        die($teste->campo[$x]->erro);
                    }
                }
                break;
            default:
                die('desconhecido');
        }

        //aqui entra o campo
// $tmp = maiusculo($tmp);   para tirar maiusculo

        if (strtoupper($teste->campo[$x]->tipo) == 'D' and empty($tmp)) {
            $campo .= ", $txt= null";
        } else {
            $campo .= ", $txt='$tmp'";
        }

//        $campo .= ", $txt='$tmp'";
    }

    $campo = substr($campo, 1);
    $sql = "UPDATE $tabela set $campo where $chave;";

    $conn = pg_connect($conectar) or
            die("N&atilde;o efetuou conex&atilde;o com $host");

    $resultado = pg_query($conn, $sql);
    if (!$resultado) {
        pg_close($conn);
        die("Falha ao gravar sql<hr />$sql");
    }
    pg_free_result($resultado);
    pg_close($conn);
}

//
// lista todos os campos
function JSlistar($tabela, $codigo, $ordem='')
{
    if (is_file('../refer.php')) {
        include '../refer.php';
        include_once('../biblioteca.php');
    } else {
        include './refer.php';
        include_once('./biblioteca.php');
    }
// echo "conectar $conectar";
    if (strlen($ordem) > 0) {
        $ordem = ' order by ' . $ordem;
    }
    $sql = "select * from $tabela where $codigo $ordem;";
    $conn = pg_connect($conectar) or
            die("N&atilde;o efetuou conex&atilde;o com $host");

    $resultado = pg_query($conn, $sql);
    if (!$resultado) {
        pg_close($conn);
        die("Falha ao gravar sql<hr />$sql");
    }

    header("Content-type: application/xml; charset=UTF-8");

    if (pg_num_rows($resultado) != 1) {
        pg_free_result($resultado);
        pg_close($conn);
        die('<retornos><ok>0</ok></retornos>');
    }
    $vtr = pg_fetch_array($resultado, 0, PGSQL_ASSOC);
    pg_free_result($resultado);
    pg_close($conn);

    echo '<retornos><ok>1</ok>';
    reset($vtr);
    foreach ($vtr as $chave => $valor) {
        if ($lang == 'utf8') {
            echo "<$chave><![CDATA[", trim($valor), "]]> </$chave>";
        } else {
            echo "<$chave><![CDATA[", utf8_encode(trim($valor)), "]]> </$chave>";
        }
    }
    echo '</retornos>';
}

// Retorna um registro no formato objeto a partir do codigo
function JSregistro($tabela, $codigo){
    if (is_file('../refer.php')) {
        include '../refer.php';
        include_once('../biblioteca.php');
    } else {
        include './refer.php';
        include_once('./biblioteca.php');
    }
    $sql = "select * from $tabela where $codigo;";
    $conn = pg_connect($conectar) or
            die("N&atilde;o efetuou conex&atilde;o com $host");

    $resultado = pg_query($conn, $sql);
    if (!$resultado) {
        pg_close($conn);
        die("Falha ao gravar sql<hr />$sql");
    }

    if (pg_num_rows($resultado) != 1) {
        pg_free_result($resultado);
        pg_close($conn);
        die('Sem registro');
    }
    $obj = pg_fetch_object($resultado, 0);
    pg_free_result($resultado);
    pg_close($conn);

    return $obj;
}
?>
