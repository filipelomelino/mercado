/*- inclui foto
 * Renato Gravino Neto 20150515
 */
function incluirfototrator() {
  alert('');
  $('#incFoto').ajaxForm({
    beforeSubmit: function (arr, $form, options) {
      // The array of form data takes the following form: 
      // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 

      // return false to cancel submit
      var txt = $.trim($("input[name='arquivo']").val());
      if (!txt.length) {
        alert("Escolha o arquivo");
        return false;
      }

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
        $('#idcorpo').html('Arquivo enviado !');
        $("#barraprogresso").css("width", '0%');
        $('#porcentagem').html('0%');
      } else {
        $('#idcorpo').html(data.msg);
      }
    },
    error: function (data) {
      $('#idcorpo').html('Erro ao enviar arquivo !' + data.msg);
    },
    dataType: 'json',
    url: 'gravaimagem.php',
    resetForm: true
  }).submit();




};




$('#btnNovafotoxxx').click(function () {

  $('#formitemnovo').ajaxForm({
    beforeSubmit: function (arr, $form, options) {
      // The array of form data takes the following form: 
      // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 

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
        $('#idcorpo').html('Arquivo enviado !');
        $("#barraprogresso").css("width", '0%');
        $('#porcentagem').html('0%');
      } else {
        $('#idcorpo').html(data.msg);
      }
    },
    error: function (data) {
      $('#idcorpo').html('Erro ao enviar arquivo !' + data.msg);
    },
    dataType: 'json',
    url: 'alterafoto.php',
    resetForm: true
  }).submit();
}); //fim do click function


function escolhearquivo() {
  $("#resposta").text($("input[name='arquivo']").val());
};