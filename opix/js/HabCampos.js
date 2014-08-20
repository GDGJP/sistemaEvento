function HabCampos() {
  if (document.getElementById('mantenedor').checked){
    document.getElementById('campo').style.display = "";
	document.getElementById('campos2').style.display = "none";
  }else{
    document.getElementById('campo').style.display = "none";

  }
}

function HabCampos2() {
  if (document.getElementById('contribuinte').checked){
    document.getElementById('campos2').style.display = "";
    document.getElementById('campo').style.display = "none";

  }else{
    document.getElementById('campos2').style.display = "none";

  }
}

function HabCampos3() {
 
    document.getElementById('end').style.display = "";
    document.getElementById('butend').style.display = "none";

}

function HabCampos4() {
 
    document.getElementById('rep2').style.display = "";
    document.getElementById('butrep1').style.display = "none";

}

function HabCampos5() {
 
    document.getElementById('rep3').style.display = "";
     document.getElementById('butrep2').style.display = "none";

}
function HabCampos6() {
 
    document.getElementById('ema1').style.display = "";
     document.getElementById('but1').style.display = "none";

}
function HabCampos7() {
 
    document.getElementById('ema2').style.display = "";
     document.getElementById('but2').style.display = "none";

}

function HabCampos8() {
 
    document.getElementById('tel1').style.display = "";
     document.getElementById('Rem1').style.display = "";


}
function RemCampos8() {
 
    document.getElementById('tel1').style.display = "none";
     document.getElementById('Rem1').style.display = "none";


}
function HabCampos9() {
 
    document.getElementById('cel1').style.display = "";
   

}
function RemCampos9() {
 
    document.getElementById('cel1').style.display = "none";
     document.getElementById('Rem2').style.display = "none";


}
function HabCampos10() {
 
    document.getElementById('outro').style.display = "";
   

}
function RemCampos8() {
 
    document.getElementById('outro').style.display = "none";
     document.getElementById('Rem3').style.display = "none";


}


function HabCamposB2() {
  if (document.getElementById('nao').checked){
    document.getElementById('frmAssociado').style.display = "";
    document.getElementById('associado').style.display = "none";
	document.getElementById('associado2').style.display = "none";
	
  }else{
    document.getElementById('frmAssociado').style.display = "none";

  }
}

function HabCamposB1() {
  if (document.getElementById('sim').checked){
    document.getElementById('associado').style.display = "";
	document.getElementById('frmAssociado').style.display = "none";
  }else{
    document.getElementById('associado').style.display = "none";

  }
}

function HabCamposB3() {
  if (document.getElementById('fisica').checked){
    document.getElementById('pfisica').style.display = "";
    document.getElementById('pjuridica').style.display = "none";

	
  }else{
    document.getElementById('pfisica').style.display = "none";

  }
}

function HabCamposB4() {
  if (document.getElementById('juridica').checked){
    document.getElementById('pjuridica').style.display = "";
	document.getElementById('pfisica').style.display = "none";
  }else{
    document.getElementById('pjuridica').style.display = "none";

  }
}



function HabCamposEventos() {
	  if (document.getElementById('pessoaJuridica').checked){
	    document.getElementById('empresa').style.display = "";
		document.getElementById('pessoa').style.display = "none";
	  }else{
	    document.getElementById('empresa').style.display = "none";

	  }
	}
function HabCamposEventos1() {
	  if (document.getElementById('pessoaFisica').checked){
	    document.getElementById('pessoa').style.display = "";
		document.getElementById('empresa').style.display = "none";

	  }else{
	    document.getElementById('pessoa').style.display = "none";

	  }
	}