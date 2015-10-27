/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function passarVariavelJQueryParaPHP(novo, tipo) {
    data = {};
    data.novo = novo;
    data.tipo = tipo;
    alert(novo);
    alert(tipo);
    $.ajax({
        type: 'post',
        url: 'listprodutos.php',
        data: data,
        dataType: 'html',
        success: function (xhr) {


        },
        error: function (xhr) {
            $("div#error").html('Erro ao passar variavel: ' + xhr.responseText);
        }
    });
}
;

function enviapesquisaok(dado) {
    $("#resp").html(dado);

}
;



$('#s_novo').change(
        function () {
            var tipo = $(this).val();

            var novo = $('#s_novo option:selected').val();

            passarVariavelJQueryParaPHP(novo, tipo);
            $("#resp").show('slow');
            //$.post('listprodutos.php', novo, enviapesquisaok);
            $("#resp").load('listprodutos.php');


        }
);



$('#tipo').change(
        function () {
            var tipo = $(this).val();

            var novo = $('#s_novo option:selected').val();

            passarVariavelJQueryParaPHP(novo, tipo);
            $("#resp").show('slow');
            //$.post('listprodutos.php', novo, enviapesquisaok);

        }
);




