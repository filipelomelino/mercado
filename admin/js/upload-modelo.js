/*- Agencia Mouse - envio de arquivos
 * Modulo escrito por:  http://www.rafaelwendel.com
 * alterado por Renato Gravino Neto
 * 2012-09-12    update 2012-09-13
 * ---------------------------------------- */
$(document).ready(function(){
    $('#btnEnviar').click(function(){
        $('#formUpload').ajaxForm({
            uploadProgress: function(event, position, total, percentComplete) {
                $('progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },
            success: function(data) {
                $('progress').attr('value','100');
                $('#porcentagem').html('100%');
                if(data.sucesso == true){
                    //$('#resposta').html('<img src="'+ data.msg +'" />');
                    $('#resposta').html('sucesso!!! '+ data.tipo );
                    console.log(data);
                }
                else{
                    $('#resposta').html(data.msg);
                }
            },
            error : function(){
                $('#resposta').html('Erro ao enviar requisição!!!');
            },
            dataType: 'json',
            url: 'documentos/enviar_arquivo.php',
            resetForm: true
        }).submit();
    })
})
