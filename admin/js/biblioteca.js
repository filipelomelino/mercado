/*- Agencia mouse - modulo com funcoes genericas
 * Renato Gravino Neto 2012-09-05
 * update: 2012-09-05
 * ----------------------------------------------*/
////----------------
//genericas
function float2moeda(num) {
 x = 0;
 if(num<0) {
    num = Math.abs(num);
    x = 1;
 }

 if(isNaN(num)) num = "0";
    cents = Math.floor((num*100+0.5)%100);

 num = Math.floor((num*100+0.5)/100).toString();

 if(cents < 10) cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
       num = num.substring(0,num.length-(4*i+3))+'' //neste seria o ponto
             +num.substring(num.length-(4*i+3));

 ret = num + '.' + cents;

 if (x == 1) ret = ' - ' + ret;return ret;

}

//Pega um valor formatado com virgula e separador de milha e o transforma em float
function moeda2float(moeda){
   moeda = $.trim(moeda);
   if(moeda.length <1){
       return 0;
   }
  moeda = moeda.replace(",",".");
  moeda = parseFloat(moeda);
  if(isNaN(moeda)){
      moeda=0;
  }
  return moeda;
}


//----------------------------
//Testa cpf

function VerificaCPF(cpf){
   cpf = cpf.replace(/[.,\/-]/g,"");

   if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
      return false;
   var add = 0;
   for (var i=0; i < 9; i ++)
      add += parseInt(cpf.charAt(i)) * (10 - i);

   var rev = 11 - (add % 11);
   if (rev == 10 || rev == 11)
      rev = 0;
   if (rev != parseInt(cpf.charAt(9)))
      return false;
   add = 0;
   for (i = 0; i < 10; i ++)
      add += parseInt(cpf.charAt(i)) * (11 - i);
   rev = 11 - (add % 11);
   if (rev == 10 || rev == 11)
      rev = 0;
   if (rev != parseInt(cpf.charAt(10)))
      return false;
   return true;

}

//------------------------------------------------
//verifica formato email
function VerificaEmail(email){
   var expregemail = /^[\w-]+(\.[\w-]+)*@(([\w-]{2,63}\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])$/;
   return expregemail.test(email);
}
//------------------------------
//verifica se apenas digitos
function VerificaDigito(pStr){
   var reDigits = /^\d+$/;
   return reDigits.test(pStr);
}
//------------------------------
//verifica data
function VerificaData(ano,mes,dia){
    var bi = ano % 4;
    if ((dia < 01) || (dia < 01 || dia > 30) && (mes == 4 || mes == 6 || mes == 9 || mes == 11) || dia > 31) return false;
    if (mes < 01 || mes > 12) return false;
    if (mes == 2 && (dia < 01 || dia > 29 || (dia > 28 && bi))) return false;
return true;
}
//----------------------------------------
//verifica hora
function VerificaHora(pStr){
   var reDigits = /^([0-1]\d|2[0-3]):[0-5]\d$/;
   return reDigits.test(pStr);
}

//testa cnpj
function VerificaCNPJ(CNPJ) {
   CNPJ=$.trim(CNPJ);
   if (!(CNPJ.length== 18 || CNPJ.length == 14)){
      return false;
   }
   //substituir os caracteres que nao sao numeros
   CNPJ = CNPJ.replace(/[.,\/-]/g,""); //tanks eclesiastes ;)

   var nonNumbers = /\D/;
   if (nonNumbers.test(CNPJ)){
      return false;
   }
   var a = [];
   var b = new Number;
   var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
   for (i=0; i<12; i++){
      a[i] = CNPJ.charAt(i);
      b += a[i] * c[i+1];
   }
   if ((x = b % 11) < 2) { a[12] = 0; } else { a[12] = 11-x; }
   b = 0;
   for (y=0; y<13; y++) {
      b += (a[y] * c[y]);
   }
   if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
   if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
         return false;
   }
   return true;
}
function inputNumerico(valor, vid){
   var tmp,vlr = $.trim($(valor).val());
   if(vlr.length<1){
      $("#"+vid).empty();
      return true;
   }
   tmp = moeda2float(vlr);
   if(!isNaN(tmp)) {
      $("#"+vid).html('<img src="imagem/certo.jpg">').removeClass().addClass('certo');
   } else {
      $("#"+vid).html('<img src="imagem/erro.jpg">').removeClass().addClass('errado');
   }

}
function inputNumericoOut(valor){
   var tmp,vlr = $.trim($(valor).val());
   tmp = moeda2float(vlr);
   if(!isNaN(tmp)) {
      // esta certo
      $(valor).val(tmp);
   } else {
      $(valor).empty();
   }

}
// tira zero a esquerda
function tirazero(sStr){
   // vou usar  expressao regular pq nao quero que mude para inteiro
   return sStr.replace(/^0+/,'');

   //  return parseInt(sStr,10);
   // segunda forma abaixo
   // parseInt("000123".replace(/^0+/,'')) => 123  usando expressao regular ;)
   /*- abaixo documentada e a forma classica acima otimizada ;)
   var i;
   for(i=0;i<sStr.length;i++)
      if(sStr.charAt(i)!='0')
         return sStr.substring(i);
   return parseInt(sStr);
   -*/
}
// -- data extenso
function dataextenso(saida){
   var mes= new Array(12);
   var hoje = new Date();
   var strhoje='';
   mes[0]='Janeiro';
   mes[1]='Fevereiro';
   mes[2]='Março';
   mes[3]='Abril';
   mes[4]='Maio';
   mes[5]='Junho';
   mes[6]='Julho';
   mes[7]='Agosto';
   mes[8]='Setembro';
   mes[9]='Outubro';
   mes[10]='Novembro';
   mes[11]='Dezembro';
   strhoje=hoje.getDate();
   strhoje+= ' de '+mes[hoje.getMonth()];
   strhoje+= ' de '+hoje.getFullYear();
   $(saida).html(strhoje);
}

