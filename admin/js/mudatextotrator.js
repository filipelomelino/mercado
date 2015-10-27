/*-
 * Gravar mudanca de texto
 */
var inicio = function () {
  $("textarea").cleditor({
    width: 544
  });

  $("#ano").setMask({
    mask: "9999"
  });
  $("#preco").setMask({
    mask: "99.999999999",
    type: 'reverse',
    defaultValue: '000'
  });


};


$("#modelo").focus();

var gravaalttrator = function () {
  var parametro = {};
  parametro.codigo = $.trim($("#codigo").val());
  parametro.modelo = $.trim($("#modelo").val());
  if (parametro.modelo.length < 1) {
    alert("Campo modelo vazio...");
    $("#modelo").focus();
    return true;
  }
  parametro.marca = $.trim($("#marca").val());
  if (parametro.marca.length < 1) {
    alert("Campo marca vazio...");
    $("#marca").focus();
    return true;
  }

  parametro.novo = $.trim($('input[name=novo]:checked').val());
  parametro.cor = $.trim($("#cor").val());
  if (parametro.cor.length < 1) {
    alert("Campo cor vazio...");
    $("#cor").focus();
    return true;
  }

  parametro.combustivel = $.trim($("#combustivel").val());
  if (parametro.combustivel.length < 1) {
    alert("Campo combustível vazio...");
    $("#combustivel").focus();
    return true;
  }

  parametro.ano = $.trim($("#ano").val());
  if (parametro.ano.length < 1) {
    alert("Campo ano vazio...");
    $("#ano").focus();
    return true;
  }

  parametro.preco = $.trim($("#preco").val());
  if (parametro.preco.length < 1) {
    alert("Campo preco vazio...");
    $("#preco").focus();
    return true;
  }

  parametro.estoque = $.trim($('input[name=estoque]:checked').val());
  if (parametro.estoque.length < 1) {
    alert("Campo estoque vazio...");
    $("#estoque").focus();
    return true;
  }
  //  alert("vai enviar o post");
  $.post('./alteratrator.php', parametro, gravatextook);
};
var gravatextook = function (dado) {
  $('#idcorpo').html(dado);
};
//------------------------------------------------
//-------- que comecem os jogos
$(inicio);