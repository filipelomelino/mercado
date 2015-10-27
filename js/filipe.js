/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function passarVariavelJQueryParaPHP(novo, tipo){ 
    data = {};
    data.novo = novo;
    data.tipo = tipo;
    alert(novo);
    alert(tipo);
    $.ajax({
        type      : 'post', 
        url       : 'produto_list.php', 
        data      : data, 
        dataType  : 'html', 
        success   : function(xhr){
            
         alert("deu certo");  
        },
        error: function(xhr) {
            $("div#error").html('Erro ao passar variavel: ' + xhr.responseText);
        }
      }); 
};



$('#s_novo').change(
        function () {
            var tipo = $(this).val();
               
               var novo =  $('#s_novo option:selected').val();
               
               passarVariavelJQueryParaPHP(novo, tipo);
            
        }
);

$('#tipo').change(        
        function () {
               var tipo = $(this).val();
               
               var novo =  $('#s_novo option:selected').val();
               
               passarVariavelJQueryParaPHP(novo, tipo);
            
        }
);




