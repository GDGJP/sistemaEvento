  function soma(){
   var quantidade;
   var valorunitario;
   var total;
   quantidade = document.contato.quantidade.value;
   valorunitario = document.contato.valorUnitario.value;
  
   if(quantidade == "")
   {
      quantidade = 0;
   }
   if(valorunitario == "")
   {
      valorunitario = 0;
   }
   
   total = quantidade * valorunitario;
   total = ((Math.round(total*100))/100);
   total = total.toFixed(2) 
    if(document.contato.valorServico.value == null)
      document.contato.valorServico.value =0;
   else
          document.contato.valorServico.value = total;
         }