//COMO USAR:
//onkeypress="return bloqueia_alfa(event);" onkeydown="formataData(this, event);" onblur="validaData(this, '1');"


function bloqueia_alfa(pEvento)
{

	navegador = /msie/i.test(navigator.userAgent);
	if (navegador)
		var tecla = event.keyCode;
	else
		var tecla = pEvento.which;

		if (!tecla)
			return true;

		if(tecla > 47 && tecla < 58) // numeros de 0 a 9
			return true;
		else
		{
			if (tecla != 8) // backspace
				return false;
			else
				return true;
		}
}

function formataData(pObjeto, teclapres)
{

  var tecla = teclapres.keyCode;

  vr = pObjeto.value;


  if ("0123456789".search(vr.substr(vr.length-1,1)) == -1) {
      vr = vr.substr(0, vr.length-1);
      pObjeto.value = vr;
  }

  else {
    vr = vr.replace( ".", "" );
    vr = vr.replace( "-", "" );
    vr = vr.replace( "-", "" );
    vr = vr.replace( "/", "" );
    vr = vr.replace( "/", "" );
    tam = vr.length + 1;
    if ( tecla != 9 && tecla != 8 ) {
      if ( tam > 2 && tam < 5 ) {
        pObjeto.value = vr.substr( 0, tam - 2  ) + '/' + vr.substr( tam - 2, tam );
      }

      if ( tam >= 5 && tam <= 10 ) {
        pObjeto.value = vr.substr( 0, 2 ) + '/' + vr.substr( 2, 2 ) + '/' + vr.substr( 4, 4 );
      }

    }

  }

}//FIM DA FUNÇÃO

//////////////////////////////////////////////////////////////////////////

//VALIDAÇÃO DE DATA DD/MM/AAAA (EXPRESSÃO REGULAR)

//////////////////////////////////////////////////////////////////////////

//Os dias 1 a 29 ((0?[1-9]|[12]\d)) são aceitos em todos os meses (1 a 12): (0?[1-9]|1[0-2])

//Dia 30 é válido em todos os meses, exceto fevereiro (02): (0?[13-9]|1[0-2])

//Dia 31 é permitido em janeiro (01), março (03), maio (05), julho (07), agosto (08),

//outubro (10) e dezembro (12): (0?[13578]|1[02]).

//////////////////////////////////////////////////////////////////////////

function validaData(pStr, pTipo)
{
  navegador = /msie/i.test(navigator.userAgent);



  //1 = DATA DE NASCIMENTO

  //2  OUTRAS DATAS

  if (pTipo==2)
    verificarRetroatividade(pStr);


  var reDate = /^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/;

  if (reDate.test(pStr.value)) {
    //alert(pStr.value + " É UMA DATA VÁLIDA.");
  } else if (pStr.value != null && pStr.value != "") {
    alert(pStr.value + " NÃO É UMA DATA VÁLIDA.");

	if (!navegador)
		pStr.value='';

    pStr.select();
	pStr.focus();
    return false;
  }

}//FIM DA FUNÇÃO
