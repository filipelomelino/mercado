/*- Javascript que inicia com o principal depois de logado
 * Renato Gravino Neto
 * 2014-03-05   update : 
 *************************************/
var tamsenha = 6;
var mascaracleditor = {
  width: 544,
  height: 420,
  controls: "bold italic underline strikethrough subscript superscript | font size " +
    "style | color highlight removeformat | bullets numbering | alignleft center " +
    "alignright justify | rule link unlink copy paste pastetext | source"
}

// iniciando jquery
$(inicio);

function inicio() {
  $("#carregando").ajaxStart(function () {
    $(this).show();
  });
  $("#carregando").ajaxStop(function () {
    $(this).hide();
  });
  $('.dropdown-toggle').dropdown();
  // por enquanto nao  $("#idcorpo").load("home.php");
  //-- colocar fixo ao rolar
  // fix sub nav on scroll
  var $win = $(window),
    $nav = $('#divmenu'),
    navHeight = $('#divmenu').first().height(),
    navTop = $('#divmenu').length && $('#divmenu').offset().top - navHeight,
    isFixed = 0

  processScroll();

  $win.on('scroll', processScroll);

  function processScroll() {
    var i, scrollTop = $win.scrollTop()
    if (scrollTop >= navTop && !isFixed) {
      isFixed = 1;
      $nav.addClass('navbar-fixed-top');
    } else if (scrollTop <= navTop && isFixed) {
      isFixed = 0;
      $nav.removeClass('navbar-fixed-top');
    }
  }
}

// funcoes do menu
function letrator() {
  $("#idcorpo").load("./editatrator.php");
}

function lepeca() {
  $("#idcorpo").load("./editapeca.php");
}


// gravar pagina
function gravatrator() {
  var parametro = {};
  parametro.codigo = $.trim($("input#codigo").val());
  if (parametro.codigo < 1) {
    alert('codigo nao encontrado;');
    return false;
  }
  parametro.titulo = $.trim($("input#titulo").val());
  if (parametro.titulo.length() < 2) {
    alert('Titulo nao encontrado;');
    return false;
  }
  parametro.subtitulo = $.trim($("input#subtitulo").val());
  if (parametro.subtitulo.length() < 2) {
    alert('Subtitulo nao encontrado;');
    return false;
  }
  parametro.descricao = $.trim($("textarea#descricao").val());
  if (parametro.descricao.length() < 2) {
    alert('Descricao nao encontrado;');
    return false;
  }
  // $("#idcorpo").load( "./gravaproduto.php" );
  alert('parou');


}

// sair do sistema
function logout() {
  if (confirm("Deseja sair do aplicativo ?")) {
    location.href = "logout.php"
  }
  return false;
}
//Pega um valor formatado com virgula e separador de milha e o transforma em float

/*-
function moeda2float(moeda) {
  moeda = $.trim(moeda);
  if (moeda.length < 1) {
    return 0;
  }
  moeda = moeda.replace(",", ".");
  moeda = parseFloat(moeda);
  if (isNaN(moeda)) {
    moeda = 0;
  }
  return moeda;
}

-*/