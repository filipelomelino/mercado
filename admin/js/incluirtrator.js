/*- inclui produto
 * Renato Gravino Neto 20140416 
 */
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

$("#modelo").focus();

$('#btnNovafoto').click(function () {
  var titulo = $.trim($('#modelo').val());
  if (titulo.length < 2) {
    alert('Campo modelo vazio...');
    $('#marca').focus();
    return false;
  }
  var titulo = $.trim($('#marca').val());
  if (titulo.length < 2) {
    alert('Campo marca vazio...');
    $('#marca').focus();
    return false;
  }
  var titulo = $.trim($('input[name=novo]:checked').val());
  if (titulo.length < 1) {
    alert('Escolha se e novo ou usado...');
    $('#novot').focus();
    return false;
  }
  var titulo = $.trim($('#cor').val());
  if (titulo.length < 2) {
    alert('Campo cor vazio...');
    $('#cor').focus();
    return false;
  }

  var titulo = $.trim($('#combustivel').val());
  if (titulo.length < 2) {
    alert('Campo combustível vazio...');
    $('#combustivel').focus();
    return false;
  }
  var titulo = $.trim($('#ano').val());
  if (titulo.length < 2) {
    alert('Campo ano vazio...');
    $('#ano').focus();
    return false;
  }


  var titulo = $.trim($('#preco').val());
  if (titulo.length < 2) {
    alert('Campo preco vazio...');
    $('#preco').focus();
    return false;
  }

  var titulo = $.trim($('input[name=estoque]:checked').val());
  if (titulo.length < 1) {
    alert('Tem em estoque ?...');
    $('#estoquet').focus();
    return false;
  }

  $('#formitemnovo').ajaxForm({
    beforeSubmit: function (arr, $form, options) {
      // The array of form data takes the following form: 
      // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 
      //  $("#preco").val(moeda2float($("#preco").val()));
      // return false to cancel submit
      $("#divbarraprogresso").show(0);
      $("#btnEnviar, #resposta").hide(0);
    },
    uploadProgress: function (event, position, total, percentComplete) {
      //$("#divbarraprogresso").show(0);
      $("#barraprogresso").css("width", percentComplete + '%');
      $('#porcentagem').html(percentComplete + '%');
    },
    success: function (data) {
      $("#barraprogresso").css("width", '100%');
      $('#porcentagem').html('100%');
      $("#btnEnviar, #resposta").show(0);
      $("#divbarraprogresso").hide('slow');

      if (data.sucesso == true) {
        $('#resposta').html('Arquivo enviado !');
        $("#barraprogresso").css("width", '0%');
        $('#porcentagem').html('0%');
        $("#idcorpo").load("editatrator.php");
      } else {
        $('#resposta').html(data.msg);
      }
    },
    error: function (data) {
      $('#resposta').html('Erro ao enviar arquivo !' + data.msg);
    },
    dataType: 'json',
    url: 'gravaincluirtrator.php',
    resetForm: true
  }).submit();
}); //fim do click function