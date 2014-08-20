function move(MenuOrigem, MenuDestino){
 var arrMenuOrigem = new Array();
 var arrMenuDestino = new Array();
 var arrLookup = new Array();
 var i;
 for (i = 0; i < MenuDestino.options.length; i++){
 arrLookup[MenuDestino.options[i].text] = MenuDestino.options[i].value;
 arrMenuDestino[i] = MenuDestino.options[i].text;
 }
 var fLength = 0;
 var tLength = arrMenuDestino.length;
 for(i = 0; i < MenuOrigem.options.length; i++){
 arrLookup[MenuOrigem.options[i].text] = MenuOrigem.options[i].value;
 if (MenuOrigem.options[i].selected && MenuOrigem.options[i].value != ""){
 arrMenuDestino[tLength] = MenuOrigem.options[i].text;
 tLength++;
 }
 else{
 arrMenuOrigem[fLength] = MenuOrigem.options[i].text;
 fLength++;
 }
 }
 arrMenuOrigem.sort();
 arrMenuDestino.sort();
 MenuOrigem.length = 0;
 MenuDestino.length = 0;
 var c;
 for(c = 0; c < arrMenuOrigem.length; c++){
 var no = new Option();
 no.value = arrLookup[arrMenuOrigem[c]];
 no.text = arrMenuOrigem[c];
 MenuOrigem[c] = no;
 }
 for(c = 0; c < arrMenuDestino.length; c++){
 var no = new Option();
 no.value = arrLookup[arrMenuDestino[c]];
 no.text = arrMenuDestino[c];
 MenuDestino[c] = no;
 }
}
 function selecionatudoPerm(){
 var selecionados = document.getElementById('escrita');
 for(i=0; i<=selecionados.length-1; i++){
 selecionados.options[i].selected = true;
 }
  var selecionados2 = document.getElementById('leitura');
 for(i=0; i<=selecionados2.length-1; i++){
 selecionados2.options[i].selected = true;
 }
   var selecionados2 = document.getElementById('exclusao');
 for(i=0; i<=selecionados2.length-1; i++){
 selecionados2.options[i].selected = true;
 }
   var selecionados3 = document.getElementById('modulo');
 for(i=0; i<=selecionados3.length-1; i++){
 selecionados3.options[i].selected = true;
 }
 
 }