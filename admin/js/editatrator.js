/*- edita produto
 * Renato Gravino Neto 20140412 
 */
var inicio = function () {
  $("textarea").cleditor({
    width: 544
  });
};

function escolhearquivo() {
  $("#resposta").text($("input[name='arquivo']").val());
};

/*-
 * incluir Trator 
 */
var incluirtrator = function (chave) {
  var parametro = {};
  $("#idcorpo").load('./incluirtrator.php', parametro);
};

var mudaimagem = function (cod) {
  var parametro = {};
  parametro.codigo = cod;
  $.post('alteraimagem.php', parametro, alteraimagemok);
};


var alteraimagemok = function (dado) {
  $('#idcorpo').html(dado);
};

var mudatexto = function (cod) {
  var parametro = {};
  parametro.codigo = cod;
  $.post('mudatextotrator.php', parametro, mudatextook);
};

var mudatextook = function (dado) {
  $('#idcorpo').html(dado);
};

var apagatrator = function (cod) {
  var parametro = {};
  parametro.codigo = cod;
  if (!confirm('Excluir o produto?')) {
    return false;
  }

  $.post('apagatrator.php', parametro, apagatratorok);
};

var apagatratorok = function (dado) {
    $('#idcorpo').html('Apagou com sucesso');
  }
  //------------------------------------------------
  //-------- que comecem os jogos
$(inicio);