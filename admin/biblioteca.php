<?php

/* ---------------------------------
  Funcao para converter vetor do postgresql para um vetor comum retorna falso se vetor vazio
  ----------------------------------- */

// apenas numeros
function psql2vetor($prm)
{ //tkz ecl
    return json_decode(preg_replace(array('/\{/', '/\}/'), array('[', ']'), $prm));
}

function vetor2psql($vlr)
{
    return preg_replace(array('/\[/', '/\]/'), array('{', '}'), json_encode($vlr));
}

// aqui pega textos tambem cria um vetor com itens do array pgsql
function psql2item($prm)
{
    $prm = trim(preg_replace(array('/\{/', '/\}/'), '', $prm));
    if (strlen($prm) == 0) {
        return false;
    }
    return explode(',', $prm);
}

//cria string vetor psql do array
function item2psql($prm)
{
    if (!is_array($prm)) {
        return '{}';
    }
    $prm = implode(',', $prm);
    $prm = '{' . $prm . '}';
    return $prm;
}

/* ---------------------------------
  Funcao para corrigir linha para tirar espacos colocar em maiusculo, e tirar acentos
  ----------------------------------- */

function corrigestr($varchave, $tiracento=false)
{
    require $local . 'refer.php';
    $varchave = ($lang == 'utf8') ? trim($varchave) : utf8_decode(trim($varchave));
    if ($tiracento) {
        $acentos = array(
            'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
            'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
            'C' => '/&Ccedil;/',
            'c' => '/&ccedil;/',
            'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
            'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
            'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
            'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
            'N' => '/&Ntilde;/',
            'n' => '/&ntilde;/',
            'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
            'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
            'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
            'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
            'Y' => '/&Yacute;/',
            'y' => '/&yacute;|&yuml;/',
            'a.' => '/&ordf;/',
            'o.' => '/&ordm;/');

        $varchave = preg_replace($acentos, array_keys($acentos), htmlentities($varchave, ENT_NOQUOTES, 'UTF-8'));
    }
    // tirar caracteres de injecao
   $varchave = preg_replace(array("/\'/", '/\"/','/;/','/\n/','/\r/'),'',$varchave);
   $varchave = strip_tags($varchave);
    return $varchave;
}

// fim corrigestr()
// le data em selects
function ledata($vr = "", $vano="ano_vcto", $vmes="mes_vcto", $vdia="dia_vcto")
{
    print "<select name=\"$vdia\" id=\"$vdia\">\n";
    if (!empty($vr)) {
        list($ano, $mes, $dia) = explode('-', $vr);
    } else {
        $ano = date("Y");
        $mes = date("m");
        $dia = date("d");
    }

    $y = $dia;
    for ($x = 1; $x <= 31; $x++) {
        print "<option value=$x ";
        if ($x == $y) {
            print " selected ";
        }
        print ">$x\n";
    }
    print "</select>\n";
    // meses
    $meses_txt = array('01-Janeiro', '02-Fevereiro', '03-Mar&ccedil;o', '04-Abril', '05-Maio', '06-Junho', '07-Julho', '08-Agosto', '09-Setembro', '10-Outubro', '11-Novembro', '12-Dezembro');

    print "<select name=\"$vmes\" id=\"$vmes\">\n";
    $y = $mes;
    for ($x = 1; $x <= 12; $x++) {
        print "<option value=$x ";
        if ($x == $y) {
            print " selected ";
        }
        print ">" . $meses_txt[$x - 1] . "\n";
    }
    print "</select>\n";
    print "<select name=\"$vano\" id=\"$vano\"> \n";
    $datafinal = $ano;
    for ($contador = $datafinal - 120; $contador <= $datafinal + 30; $contador++) {
        print "<option value=\"$contador\" ";
        if ($contador == $datafinal) {
            print " selected ";
        }
        print ">$contador\n";
    }
    print "</select>\n";
}

// cheka cpf
function cpf($cpf)
{
    if (!is_numeric($cpf) or strlen($cpf) != 11) {
        return false;
    }
    if (($cpf == '11111111111') or ($cpf == '22222222222') or ($cpf == '33333333333') or ($cpf == '44444444444') or ($cpf == '55555555555') or ($cpf == '66666666666') or ($cpf == '77777777777') or ($cpf == '88888888888') or ($cpf == '99999999999') or ($cpf == '00000000000')) {
        return false;
    }
    /* primeiro o script vai pegar o numero do dígito verificador */
    $dv_informado = substr($cpf, 9, 2);
    for ($i = 0; $i <= 8; $i++) {
        $digito[$i] = substr($cpf, $i, 1);
    }

    /* Agora sera calculado o valor do decimo digito de verificacao */
    $posicao = 10;
    $soma = 0;
    for ($i = 0; $i <= 8; $i++) {
        $soma = $soma + $digito[$i] * $posicao;
        $posicao = $posicao - 1;
    }
    $digito[9] = $soma % 11;
    if ($digito[9] < 2) {
        $digito[9] = 0;
    } else {
        $digito[9] = 11 - $digito[9];
    }

    /* Agora será calculado o valor do décimo primeiro dígito de verificação */
    $posicao = 11;
    $soma = 0;

    for ($i = 0; $i <= 9; $i++) {
        $soma = $soma + $digito[$i] * $posicao;
        $posicao = $posicao - 1;
    }
    $digito[10] = $soma % 11;
    if ($digito[10] < 2) {
        $digito[10] = 0;
    } else {
        $digito[10] = 11 - $digito[10];
    }

    /* Nessa parte do script será verificado se o dígito verificador é igual ao informado pelo usuário */

    $dv = $digito[9] * 10 + $digito[10];
    if ($dv != $dv_informado) {
        return false;
    }
    return true;
}

function cnpj($RecebeCNPJ)
{
//   $RecebeCNPJ=${"CampoNumero"};
    $s = '';
    for ($x = 1; $x <= strlen($RecebeCNPJ); $x = $x + 1) {
        $ch = substr($RecebeCNPJ, $x - 1, 1);
        if (ord($ch) >= 48 && ord($ch) <= 57) {
            $s.= $ch;
        }
    }
    $RecebeCNPJ = $s;
    if (strlen($RecebeCNPJ) != 14) {
        return false;
    } elseif ($RecebeCNPJ == "00000000000000") {
        return false;
    } else {
        $Numero[1] = intval(substr($RecebeCNPJ, 0, 1));
        $Numero[2] = intval(substr($RecebeCNPJ, 1, 1));
        $Numero[3] = intval(substr($RecebeCNPJ, 2, 1));
        $Numero[4] = intval(substr($RecebeCNPJ, 3, 1));
        $Numero[5] = intval(substr($RecebeCNPJ, 4, 1));
        $Numero[6] = intval(substr($RecebeCNPJ, 5, 1));
        $Numero[7] = intval(substr($RecebeCNPJ, 6, 1));
        $Numero[8] = intval(substr($RecebeCNPJ, 7, 1));
        $Numero[9] = intval(substr($RecebeCNPJ, 8, 1));
        $Numero[10] = intval(substr($RecebeCNPJ, 9, 1));
        $Numero[11] = intval(substr($RecebeCNPJ, 10, 1));
        $Numero[12] = intval(substr($RecebeCNPJ, 11, 1));
        $Numero[13] = intval(substr($RecebeCNPJ, 12, 1));
        $Numero[14] = intval(substr($RecebeCNPJ, 13, 1));

        $soma = $Numero[1] * 5 + $Numero[2] * 4 + $Numero[3] * 3 + $Numero[4] * 2 + $Numero[5] * 9 + $Numero[6] * 8 + $Numero[7] * 7 +
                $Numero[8] * 6 + $Numero[9] * 5 + $Numero[10] * 4 + $Numero[11] * 3 + $Numero[12] * 2;
        $soma = $soma - (11 * (intval($soma / 11)));

        if ($soma == 0 || $soma == 1) {
            $resultado1 = 0;
        } else {
            $resultado1 = 11 - $soma;
        }
        if ($resultado1 == $Numero[13]) {
            $soma = $Numero[1] * 6 + $Numero[2] * 5 + $Numero[3] * 4 + $Numero[4] * 3 + $Numero[5] * 2 + $Numero[6] * 9 + $Numero[7] * 8 + $Numero[8] * 7 + $Numero[9] * 6 + $Numero[10] * 5 + $Numero[11] * 4 + $Numero[12] * 3 + $Numero[13] * 2;
            $soma = $soma - (11 * (intval($soma / 11)));
            if ($soma == 0 || $soma == 1) {
                $resultado2 = 0;
            } else {
                $resultado2 = 11 - $soma;
            }
            if ($resultado2 == $Numero[14]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

/* ---------------------------------
  Funcao para mostrar qualquer base dados (nome_variavel,unidadepadrao,tabela)
  ----------------------------------- */

function legenerico($var_dsk="vorigem", $grupo_default=0, $vtabela, $vcoluna="descricao", $primvazio=false, $vtexto="Escolha...", $cod='codigo', $vfiltro='')
{
    require $local . 'refer.php';
    /* - A funcao acima substitui
     *   if(file_exists("../refer.php")){
      include "../refer.php";
      } else {
      include "../../refer.php";
      }
     *
     */
    if (strlen($vfiltro) > 1) {
        $vfiltro = ' where ' . $vfiltro;
    }
    print "<select name=\"$var_dsk\" id=\"$var_dsk\">";
    if ($primvazio) { // cria o selecionar abaixo
        print "<option value=\"0\" selected>$vtexto</option>";
    }
    $conn = pg_connect($conectar);
    if (!$conn) {
        print "<H1> Falha ao acessar a base de dados</h1>";
        exit;
    };
    // seleciona
    $resultado = pg_exec($conn, "select * from $vtabela $vfiltro order by lower(tiraacento($vcoluna));");
    if (!$resultado) {
        print "<H1>N&atilde;o foi possivel efetuar a consulta<h1>";
        pg_freeresult($resultado);
        pg_close($conn);
        exit;
    }
    //conta linhas e colunas
    $num_linha = pg_numrows($resultado);
    // executa até o final da tabela
    for ($cont_linha = 0; $cont_linha < $num_linha; $cont_linha++) {
        $campo = pg_fetch_array($resultado, $cont_linha);
        //parei aqui determinar utf-8 ou iso
        print "<option value=\"" . $campo[$cod] . "\" ";
        print ($campo[$cod] == $grupo_default) ? " Selected " : "";
        print " >";
        echo trim(($lang == 'utf8') ? $campo[$vcoluna] : utf8_encode($campo[$vcoluna])), "\n";
    } // end for
    pg_freeresult($resultado);
    pg_close($conn);
    print "</select>";
}

//---------final funcao
// converte de ano-mes-dia pra dia/mes/ano

function convdata($cmp)
{

    if (empty($cmp)) {
        return "";
    }
    $hora = '';
    $data = $cmp;
    if (strlen($cmp) > 10) {
        $hora = substr($cmp, 11, 8);
        $data = substr($cmp, 0, 10);
    }
    $cmp = join('/', array_reverse(explode('-', $data)));
    $cmp .=' ' . $hora;
    return $cmp;
    /* - list($ano,$mes,$dia)=explode('-',$cmp);
      return "$dia/$mes/$ano";  - */
}

//
/*
  $origem   caminho at foto de origem
  $destino  destino, caminho ate o diretorio que deseja armazenar o thumbnail
  $largura  largura que voce deseja que o thumbnail tenha. O valor da altura
  sera proporcional ao tamnho do original, utilizando $largura como
  referencia.
  $pre      prefixo que sera adicionado ao nome do thumbnail.
  $formato  formato do arquivo: opcoes JPEG e PNG

  Requisitos:
  PHP 4+ e GD Lib (de acordo com a versao do GD instalado a funcao utilizar� o thumbnail com a melhor qualidade possivel)
 */
function criar_thumbnail($origem, $destino='./', $largura='300', $pre='tn_', $formato='JPEG')
{

    switch ($formato) {
        case 'JPEG':
            $tn_formato = 'jpg';
            break;
        case 'PNG':
            $tn_formato = 'png';
            break;
    }
    $ext = preg_split("/(\.|\/)/", strtolower($origem)); // zero bala
    $n = count($ext) - 1;
    $ext = $ext[$n];

    $arr = preg_split("/\//", $origem); //zero bala
    $n = count($arr) - 1;
    $arra = explode('.', $arr[$n]);
    $n2 = count($arra) - 1;
    $tn_name = str_replace('.' . $arra[$n2], '', $arr[$n]);
    $destino = $destino . $pre . $tn_name . '.' . $tn_formato;

    if ($ext == 'jpg' || $ext == 'jpeg') {
        $im = imagecreatefromjpeg($origem);
    } elseif ($ext == 'png') {
        $im = imagecreatefrompng($origem);
    } elseif ($ext == 'gif') {
        return false;
    }
    $w = imagesx($im);
    $h = imagesy($im);
    if ($w > $h) {
        $nw = $largura;
        $nh = ($h * $largura) / $w;
    } else {
        $nh = $largura;
        $nw = ($w * $largura) / $h;
    }
    if (function_exists('imagecopyresampled')) {
        if (function_exists('imageCreateTrueColor')) {
            $ni = imageCreateTrueColor($nw, $nh);
        } else {
            $ni = imagecreate($nw, $nh);
        }
        if (!@imagecopyresampled($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h)) {
            imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
        }
    } else {
        $ni = imagecreate($nw, $nh);
        imagecopyresized($ni, $im, 0, 0, 0, 0, $nw, $nh, $w, $h);
    }
    if ($tn_formato == 'jpg') {
        imagejpeg($ni, $destino, 60);
    } elseif ($tn_formato == 'png') {
        imagepng($ni, $destino);
    }
    unset($ni);
    unset($in);
}

/* - funcao dinheiro , corta em 2 casas decimais - */

function dinheiro($cmp)
{
    return (double) (((double) round($cmp * 100)) / 100);
}

// Corrige a quantidade em casas decimais determinado pelo $maskdecimal e $mask
function chkquantidade($cmp){
    if(!isset($maskdecimal)){
        die('erro chkquantidade');
    //  require $local . 'refer.php';
    }
    $base = '1' . str_repeat('0', $maskdecimal);

    return (double) (((double) round($cmp * $base)) / $base);
}

// elimina o zero inicial
function tirazero($vcod)
{
    for ($conta = 0; $conta < strlen($vcod); $conta++) {
        if (substr($vcod, $conta, 1) != 0) {
            break;
        }
    }
    $x = substr($vcod, $conta);
    return (empty($x)) ? 0 : $x;
}
//-- converte as funcoes para sql
function data2sql($dt)
{
    $dt = trim($dt);
    if (empty($dt)) {
        return false;
    }
    $tmp = explode('/', $dt);
    if (!checkdate($tmp[1], $tmp[0], $tmp[2])) {
        return false;
    }
    return implode('-', array_reverse($tmp));
}

function sql2data($dt)
{
    $dt = trim($dt);
    if (empty($dt)) {
        return false;
    }
    $tmp = explode('-', $dt);
    if (!checkdate($tmp[1], $tmp[2], $tmp[0])) {
        return false;
    }
    return implode('/', array_reverse($tmp));
}

/**
 *  funcao para testar se corresponde ao contabil
 */
function testacontabil($vlr)
{
    require $local . 'refer.php';
    // echo 'Contabil ',$vlr, 'mascara ' , $mascaracontabil;
    return true;
}

//converte para maiusculo e corrige acentos
function maiusculo($vlr)
{
    $vlr = strtoupper(corrigestr($vlr));
    $origem = array('/á/', '/à/', '/ã/', '/â/', '/é/', '/è/', '/ê/', '/í/', '/ì/', '/ĩ/', '/î/', '/ó/', '/ò/', '/õ/', '/ô/', '/ú/', '/ù/', '/ũ/', '/û/', '/ç/');
    $destino = array('Á', 'À', 'Ã', 'Â', 'É', 'È', 'Ê', 'Í', 'Ì', 'Ĩ', 'Î', 'Ó', 'Ò', 'Õ', 'Ô', 'Ú', 'Ù', 'Ũ', 'Ũ', 'Ç');
    $vlr = preg_replace($origem, $destino, $vlr);
    return $vlr;
}

function minusculo($vlr)
{
    $vlr = strtolower(corrigestr($vlr));
    $origem = array('/Á/', '/À/', '/Ã/', '/Â/', '/É/', '/È/', '/Ê/', '/Í/', '/Ì/', '/Ĩ/', '/Î/', '/Ó/', '/Ò/', '/Õ/', '/Ô/', '/Ú/', '/Ù/', '/Ũ/', '/Ũ/', '/Ç/');
    $destino = array('á', 'à', 'ã', 'â', 'é', 'è', 'ê', 'í', 'ì', 'ĩ', 'î', 'ó', 'ò', 'õ', 'ô', 'ú', 'ù', 'ũ', 'û', 'ç');
    $vlr = preg_replace($origem, $destino, $vlr);
    return $vlr;
}

function estado($vuf, $nome='UF', $id='UF')
{
    $vuf = trim($vuf);

    $vtr = array("  " => '----------',
        "AC" => 'Acre',
        "AL" => 'Alagoas',
        "AP" => 'Amapá',
        "AM" => 'Amazonas',
        "BA" => 'Bahia',
        "CE" => 'Ceará',
        "DF" => 'Distrito Federal',
        "ES" => 'Espírito Santo',
        "GO" => 'Goias',
        "MA" => 'Maranhão',
        "MT" => 'Mato Grosso',
        "MS" => 'Mato Grosso do Sul',
        "MG" => 'Minas Gerais',
        "PA" => 'Pará',
        "PB" => 'Paraíba',
        "PR" => 'Paraná',
        "PE" => 'Pernambuco',
        "PI" => 'Piaui',
        "RJ" => 'Rio de Janeiro',
        "RN" => 'Rio Grande do Norte',
        "RS" => 'Rio Grande do Sul',
        "RO" => 'Rondônia',
        "RR" => 'Roraima',
        "SC" => 'Santa Catarina',
        "SP" => 'São Paulo',
        "SE" => 'Sergipe',
        "TO" => 'Tocantins');
    reset($vtr);
    echo "<select id=\"$id\" name=\"$nome\">";
    foreach ($vtr as $key => $value) {
        echo "<option value=\"$key\"";
        if ($vuf == $key)
            echo ' selected ';
        echo ">$value</option>";
    }
    echo '</select>';
}

// funcao para pegar um textarea e transformar em string (cleditor inside)
function textarea2string($txt)
{
    $txt = preg_replace(array('/</', '/>/'), array('[', ']'), $txt);
    return pg_escape_string($txt);
}

// funcao para pegar string e preencher para textarea
function string2textarea($txt)
{
    return preg_replace(array('/\[/', '/\]/'), array('<', '>'), $txt);
}
// funcao para cortar palavras
function limit_words($string, $word_limit)
{
   $words = explode(" ",$string);
   return implode(" ",array_splice($words,0,$word_limit));
}
// funcao para converter string em url amigaveis
function convertStringByUrlString($String){

$Separador = "-";

$String = trim($String); //Removendo espaços do inicio e do fim da string
$String = strtolower($String); //Convertendo a string para minúsculas
$String = strip_tags($String); //Retirando as tags HTML e PHP da string
$String = eregi_replace("[[:space:]]", $Separador, $String); //Substituindo todos os espaços por $Separador

$String = eregi_replace("[çÇ]", "c", $String); //Substituindo caracteres especiais pela letra respectiva
$String = eregi_replace("[áÁäÄàÀãÃâÂ]", "a", $String);
$String = eregi_replace("[éÉëËèÈêÊ]", "e", $String);
$String = eregi_replace("[íÍïÏìÌîÎ]", "i", $String);
$String = eregi_replace("[óÓöÖòÒõÕôÔ]", "o", $String);
$String = eregi_replace("[úÚüÜùÙûÛ]", "u", $String);

$String = eregi_replace("(\()|(\))", $Separador, $String); //Substituindo outros caracteres por "$Separador"
$String = eregi_replace("(\/)|(\\\)", $Separador, $String);
$String = eregi_replace("(\[)|(\])", $Separador, $String);
$String = eregi_replace("[@#\$%&\*\+=\|º]", $Separador, $String);
// $String = eregi_replace("[;:'\"<>,\.?!_-]", $Separador, $String);
$String = eregi_replace("[;:'\"<>,\.?!-]", $Separador, $String);
// $String = eregi_replace("[""]", $Separador, $String);
$String = eregi_replace("(ª)+", $Separador, $String);
$String = eregi_replace("[`´~^°]", $Separador, $String);

$String = eregi_replace("($Separador)+", $Separador, $String); //Removendo o excesso de "$Separador" por apenas um

$String = substr($String, 0, 100); //Quebrando a string para um tamanho pré-definido

$String = eregi_replace("(^($Separador)+)|(($Separador)+$)", "", $String); //Removendo o "$Separador" do inicio e fim da string

return $String;
}
//checka se e ajax ou se veio de um web-client
function is_ajax() {
   return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
 }
?>
