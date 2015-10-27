// funcoes javascript para pegar campos , carregar campos
// pega campos do form testa validade e retorna objeto parametro
function JStestaparametro(){
    var parametro ={};
    var tmp,vdia,vmes,vano,aprovado=true;
    var inteiro,fracao,pos,tam,vtipo;

    //laco
    $("campo",estrutura).each(function(cont){
        vtipo = $("tipo",this).text().toUpperCase();
        if(vtipo =='D'){ // data
            tmp = $.trim($("input[name="+$("js dia",this).text()+"]").val() );
        } else if(vtipo=='S') { // select
            tmp = $("select[name="+$("js",this).text()+"]").val();
        } else if(vtipo=='T') { // Textarea
            tmp = $("textarea[name="+$("js",this).text()+"]").val();
        } else { // outros
            tmp = $.trim($("input[name="+$("js",this).text()+"]").val() );
        }

        if(tmp != undefined){ // so se existir formulario
            tmp='';
            switch(vtipo){
                case 'C': //caracter
                case 'c':
                    tmp = $.trim($("input[name="+$("js",this).text()+"]").val());
                    if($("obrigatorio",this).text().toUpperCase()=="S"){
                        if(tmp.length<1){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                    }
                    break;
                case 'D': //data
                case 'd':
                    tmp  =  $.trim($("input[name="+$("js",this).text()+"]").val());
                    vdia =  $.trim(tirazero(tmp.substr(0,2)));
                    vmes =  $.trim(tirazero(tmp.substr(3,2)));
                    vano =  $.trim(tirazero(tmp.substr(6,4)));

                    if(vano+vdia+vmes==''){
                        if($("obrigatorio",this).text().toUpperCase()=="S"){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        } else {
                            tmp='';
                        }
                    } else {
                        if(!VerificaData(vano, vmes, vdia)){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                        tmp = vano+'-'+vmes+'-'+vdia;
                        if(vdia==undefined){
                            tmp = '';
                        }
                    }
                    break;

                case 'N': //numerico
                case 'n':
                    tmp = $.trim($("input[name="+$("js",this).text()+"]").val());
                    if(tmp.length<1 && $("obrigatorio",this).text().toUpperCase()!="S" ){ //vazio nao insere
                        break;
                    }
                    tmp = moeda2float(tmp);
                    if(isNaN(tmp)){
                        alert('NaN: '+$("erro",this).text());
                        $("input[name="+$("js",this).text()+"]").focus();
                        aprovado = false;
                        return false;
                    }
                    //verifica o tamanho do elemento
                    tam = $("tam",this).text();
                    pos = tam.indexOf(",");
                    if(pos< 0){
                        inteiro = parseInt(tam);
                        fracao = 0;
                    } else {
                        inteiro=parseInt(tam.substring(0,pos));
                        fracao =parseInt(tam.substring(pos+1,tam.length));
                        if(isNaN(inteiro)){
                            inteiro=0;
                        }
                    }
                    // cheka os elementos

                    if(inteiro!=0){ // se for zero nao confere tamanho
                        tmp = ""+tmp;
                        // FRACIONANDO A ENTRADA
                        pos = tmp.indexOf(".");
                        if(pos< 0){
                            inteirotmp = parseInt(tmp);
                            fracaotmp = 0;
                        } else {
                            inteirotmp=parseInt(tmp.substring(0,pos));
                            fracaotmp =parseInt(tmp.substring(pos+1,tmp.length));
                            if(isNaN(inteirotmp)){
                                inteirotmp=0;
                            }
                            if(isNaN(fracaotmp)){
                                fracaotmp=0;
                            }
                        }
                        inteirotmp=''+inteirotmp;
                        fracaotmp=''+fracaotmp;

                        // base de calculo certa
                        if(fracao>0){
                            basecalc = (inteiro-fracao)-1;
                        } else {
                            basecalc = inteiro;
                        }

                        // cheka o tamanho da base de calculo
                        if(inteirotmp.length>basecalc){
                            alert('GRANDE ('+basecalc+'.'+fracao+'): ' +$("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }

                        if(fracaotmp.length>fracao) {
                            if(fracao!=0 || fracaotmp>0 ){
                                alert('Fracao grande ('+basecalc+'.'+fracao+'): ' +$("erro",this).text());
                                $("input[name="+$("js",this).text()+"]").focus();
                                aprovado = false;
                                return false;
                            }
                        }
                        tmp = parseFloat(tmp);
                    }

                    if($("obrigatorio",this).text().toUpperCase()=="S"){
                        if(!tmp){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                    }
                    break;
                case 'S': //campo select
                case 's':
                    tmp = ''+$("select[name="+$("js",this).text()+"]").val();
                    if($("obrigatorio",this).text().toUpperCase()=="S" && tmp.length<1){
                        alert($("erro",this).text());
                        $("select[name="+$("js",this).text()+"]").focus();
                        aprovado = false;
                        return false;
                    }
                    // e zero?
                    if($("obrigatorio",this).text().toUpperCase()=="S" && parseInt(tmp)==0){
                        alert($("erro",this).text());
                        $("select[name="+$("js",this).text()+"]").focus();
                        aprovado = false;
                        return false;
                    }
                    break;
                case 'X': //campo checkBox  (xekbox)
                case 'x':
                    tmp = ( $("input[name="+$("js",this).text()+"]").is(':checked') )?'true':'false';
                    break;
                case 'CPF':
                case 'cpf':
                    tmp = $.trim($("input[name="+$("js",this).text()+"]").val());
                    tmp = tmp.replace(/[.,\/-]/g,"");
                    if($("obrigatorio",this).text().toUpperCase()=="S" && tmp.length<1){
                        alert('Obrigatorio '+$("erro",this).text());
                        $("input[name="+$("js",this).text()+"]").focus();
                        aprovado = false;
                        return false;
                    }
                    if(tmp.length>1){
                        if(!VerificaDigito(tmp) ){
                            alert('Verificadigito '+$("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                        if(!VerificaCPF(tmp)){
                            alert('Verifica CPF '+$("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                    }

                    break;
                case 'CNPJ':
                case 'cnpj':
                    tmp = $.trim($("input[name="+$("js",this).text()+"]").val());
                    tmp = tmp.replace(/[.,\/-]/g,"");
                    if($("obrigatorio",this).text().toUpperCase()=="S" &&tmp.length<1){
                        alert($("erro",this).text());
                        $("input[name="+$("js",this).text()+"]").focus();
                        aprovado = false;
                        return false;
                    }
                    if(tmp.length>1){
                        if(!VerificaDigito(tmp)){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                        if(!VerificaCNPJ(tmp)){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                    }
                    break;
                case 'T': //Textarea
                case 't':
                    tmp = $.trim($("textarea[name="+$("js",this).text()+"]").val());
                    if($("obrigatorio",this).text().toUpperCase()=="S"){
                        if(tmp.length<1){
                            alert($("erro",this).text());
                            $("textarea[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                    }
                    break;
                case 'r': //botoes de radio
                case 'R': //Radio
                    tmp = $("input:radio[name="+$("js",this).text()+"]:checked").val();
                    if(tmp==undefined){
                        if($("obrigatorio",this).text().toUpperCase()=="S"){
                            alert($("erro",this).text());
                            $("input[name="+$("js",this).text()+"]").focus();
                            aprovado = false;
                            return false;
                        }
                        tmp='';
                    }

                    break;
                default:
                    alert('Tipo Desconhecido ' +$("tipo",this).text());
            }
            //acrescenta ao vetor
            // tem um NAO na frente ou seja se nao for data com valor correto
            if(!($("tipo",this).text().toUpperCase()=='D' && vdia==undefined) ){
                if(typeof(tmp)=='sting'){
                // tmp = tmp.toUpperCase();
                }

                parametro[$("db",this).text()] = tmp;
            }
        } //fim input existe
    });
    if(aprovado) {
        return parametro;
    } else {
        return false;
    }
}
//-----------------------------------
// preenche os inputs
function JSpreencheinput(dado){
    var tmp,vdia,vmes,vano,aprovado=true;
    $("campo",estrutura).each(function(cont){
        tmp='';
        switch($("tipo",this).text()){
            case 'C': //caracter
            case 'c':
            case 'CPF': //cpf
            case 'cpf':
            case 'N': //numeric
            case 'n':
            case 'CNPJ': // cnpj
            case 'cnpj' :
                tmp = $("db",this).text();
                tmp = $(tmp,dado).text();
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'D': //data
            case 'd':
                tmp = $("db",this).text();
                tmp = $(tmp,dado).text();
                vdia = tmp.substr(8,2);
                vmes = tmp.substr(5,2);
                vano = tmp.substr(0,4);
                tmp=''+vdia+'/'+vmes+'/'+vano;
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'R': // botoes de radio
            case 'r':
                tmp = $("db",this).text();
                tmp = $(tmp,dado).text();
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            //-------------------------
            case 'X': // checkbox  ( xekbox )
            case 'x':
                tmp = $("db",this).text();
                tmp = $(tmp,dado).text();
                tmp = tmp.toUpperCase();
                if(tmp=='T'){
                    $("input[name="+$("js",this).text()+"]").attr('checked',true);
                } else {
                    $("input[name="+$("js",this).text()+"]").removeAttr('checked');
                }
                break;
            //---------------------------------
            case 'S': //campo select
            case 's':
                tmp = $("db",this).text();
                tmp = $.trim($(tmp,dado).text());
                $("select[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'T': //campo textarea
            case 't':
                tmp = $("db",this).text();
                tmp = $.trim($(tmp,dado).text());
                $("textarea[name="+$("js",this).text()+"]").val(tmp);
                break;
        }
    });
}
//-----------------------------------
// preenche os inputs pega um obj (json)
function JSpreencheinputobj(dado){
    var tmp,vdia,vmes,vano,aprovado=true,tmp2;
    $("campo",estrutura).each(function(cont){
        tmp='';
        switch($("tipo",this).text()){
            case 'C': //caracter
            case 'c':
            case 'N': //numeric
            case 'n':
                tmp = $("db",this).text();
                tmp = $.trim(dado[tmp]);// 8-(
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'CPF': //cpf
            case 'cpf':
                tmp = $("db",this).text();
                tmp = $.trim(dado[tmp]);// 8-(
                if(tmp.length>9){
                    tmp2  = tmp.substr(0,3);
                    tmp2 +='.';
                    tmp2 += tmp.substr(3,3);
                    tmp2 +='.';
                    tmp2 += tmp.substr(6,3);
                    tmp2 +='-';
                    tmp2 += tmp.substr(9);
                    tmp   = tmp2;
                }
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'CNPJ': // cnpj
            case 'cnpj' :
                tmp = $("db",this).text();
                tmp = $.trim(dado[tmp]);// 8-(
                if(tmp.length>9){
                    tmp2  = tmp.substr(0,2);
                    tmp2 +='.';
                    tmp2 += tmp.substr(2,3);
                    tmp2 +='.';
                    tmp2 += tmp.substr(5,3);
                    tmp2 +='/';
                    tmp2 += tmp.substr(8,4);
                    tmp2 +='-';
                    tmp2 += tmp.substr(12);
                    tmp   = tmp2;
                }
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'D': //data
            case 'd':
                tmp = $("db",this).text();
                tmp = $.trim(dado[tmp]);// 8-(
                if(tmp.length>6){
                    vdia = tmp.substr(8,2);
                    vmes = tmp.substr(5,2);
                    vano = tmp.substr(0,4);
                    tmp=''+vdia+'/'+vmes+'/'+vano;
                } else {
                    tmp='';
                }
                $("input[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'R': // botoes de radio
            case 'r':

                tmp = $("db",this).text();
                tmp = dado[tmp];// 8-(
                $(":radio[name="+$("js",this).text()+"]").removeAttr('checked');
                $(":radio[name="+$("js",this).text()+"][value='"+tmp+"']").attr('checked',true);
                break;
            //-------------------------
            case 'X': // checkbox  ( xekbox )
            case 'x':
                tmp = $("db",this).text();
                tmp = dado[tmp];
                tmp = tmp.toUpperCase();
                if(tmp=='T'){
                    $("input[name="+$("js",this).text()+"]").attr('checked',true);
                } else {
                    $("input[name="+$("js",this).text()+"]").removeAttr('checked');
                }
                break;

            case 'S': //campo select
            case 's':
                tmp = $("db",this).text();
                tmp = dado[tmp];// 8-(
                $("select[name="+$("js",this).text()+"]").val(tmp);
                break;
            case 'T': //campo textarea
            case 't':
                tmp = $("db",this).text();
                tmp = dado[tmp];// 8-(
                $("textarea[name="+$("js",this).text()+"]").val(tmp);
                break;
        }
    });
}
