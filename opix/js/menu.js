/*
* @package Menu Drop Down
* @copyleft (cc) 2008 UNIFACS - Desenvolvimento Web Sites - Turma 04. Alguns direitos reservados
* @licence http://www.gnu.org/licence/lgpl.html LGPL Licence
* @author Marcelo Pereira Rodrigues - marcelo@alconta.com.br
* @author Eduardo de Souza Santos - eduipd@yahoo.com.br
* @author Alexandre Valverde - alexandre_valverde@hotmail.com
* @author Danilo Pinheiro - pivamix@hotmail.com

// JavaScript Document
/*
  Fun�ao que exibe um menu drop-down horizontal em at� 3 n�veis
*/
function menuDropDown(tema) {
   moz = !(document.all);  // Testar o navegador mozilla
   nav = navigator.appName;  // Armazena o nome do navegador
   temas(tema);  // Fun�ao que retorna as cores escolhidas para o menu
   if(moz || nav == 'Opera') {
	   // Regras CSS para o Firefox, Safari e Opera
       document.styleSheets[0].cssRules[2].style.backgroundColor = cor_Menu_NaoAtiva; 
       document.styleSheets[0].cssRules[4].style.color = cor_Fonte_Menu_NaoAtiva;    
       document.styleSheets[0].cssRules[5].style.backgroundColor = cor_Submenu_NaoAtiva;    
       document.styleSheets[0].cssRules[7].style.color = cor_Fonte_Submenu_NaoAtiva;
       document.styleSheets[0].cssRules[9].style.backgroundColor = cor_Submenu_NaoAtiva;       
       document.styleSheets[0].cssRules[10].style.color = cor_Fonte_Submenu_NaoAtiva;;
   }
   else  
   {
       // Regras CSS apenas para o Internet Explorer
       document.styleSheets[0].rules[2].style.backgroundColor = cor_Menu_NaoAtiva; 
       document.styleSheets[0].rules[4].style.color = cor_Fonte_Menu_NaoAtiva;    
       document.styleSheets[0].rules[5].style.backgroundColor = cor_Submenu_NaoAtiva;    
       document.styleSheets[0].rules[7].style.color = cor_Fonte_Submenu_NaoAtiva;
       document.styleSheets[0].rules[9].style.backgroundColor = cor_Submenu_NaoAtiva;       
       document.styleSheets[0].rules[10].style.color = cor_Fonte_Submenu_NaoAtiva;;
   }
   var navItems = document.getElementById("menu_dropdown").getElementsByTagName("li");  // Armazena o conte�do de todas as tags "li" do id "menu_dropdown"
   var links = document.getElementById("menu_dropdown").getElementsByTagName("a");  // Armazena o conte�do de todas as tags "a" do id "menu_dropdown"

   for (var i=0; i< navItems.length; i++) {  // La�o de repeti�ao que percorre todos o items do menu e muda as propriedades da CSS
      if(navItems[i].className == "submenu") {
         if(navItems[i].getElementsByTagName('ul')[0] != null) {
			// Controla a exibi�ao dos menus verticais e altera a cor de fundo dos mesmos
			navItems[i].onmouseover=function() {this.getElementsByTagName('ul')[0].style.display="block";this.style.backgroundColor = cor_Menu_Ativa;}
            navItems[i].onmouseout=function() {this.getElementsByTagName('ul')[0].style.display="none";this.style.backgroundColor = cor_Menu_NaoAtiva;}
			// Alterar a cor da fonte da classe submenu
			links[i].onmouseover=function() {this.style.color = cor_Fonte_Menu_Ativa;}
		    links[i].onmouseout=function() {this.style.color = cor_Fonte_Menu_NaoAtiva;}			
         } // fim if menu
      } // fim if submenu
      if(navItems[i].className == "item") {
		 // Alterar a cor de fundo da classe item
         navItems[i].onmouseover=function() {this.style.backgroundColor = cor_Submenu_Ativa;}
         navItems[i].onmouseout=function() {this.style.backgroundColor = cor_Submenu_NaoAtiva;}
		 // Alterar a cor da fonte da classe item
         links[i].onmouseover=function() {this.style.color = cor_Fonte_Submenu_Ativa;}
		 links[i].onmouseout=function() {this.style.color = cor_Fonte_Submenu_NaoAtiva;}		  
      } // fim if item
   } // fim for
} // fim funcao 

/* 
Fun�ao que recebe o c�digo do tema a ser utilizado pela fun�ao menuDropDown() e retorna
as cores de fundo da barra de menus, dos submenus e das fontes. 
*/
function temas(tema) {
  switch(tema) {
       case 1 : //preto
		   cor_Menu_Ativa = '#FFFFFF';
		   cor_Menu_NaoAtiva = '#000000'; 
		   cor_Fonte_Menu_Ativa = '#000000';
		   cor_Fonte_Menu_NaoAtiva = '#999999';
		   cor_Submenu_Ativa = '#FFFFFF';
		   cor_Submenu_NaoAtiva = '#000000';
		   cor_Fonte_Submenu_Ativa = '#000000';
		   cor_Fonte_Submenu_NaoAtiva = '#999999';
           break
       case 2 : //branco
		   cor_Menu_Ativa = '#000000';
		   cor_Menu_NaoAtiva = '#FFFFFF'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#999999';
		   cor_Submenu_Ativa = '#000000';
		   cor_Submenu_NaoAtiva = '#FFFFFF';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#999999';
           break
		case 3 : //azul
		   cor_Menu_Ativa = '#000000';
		   cor_Menu_NaoAtiva = '#0000FF'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#FFFFFF';
		   cor_Submenu_Ativa = '#000000';
		   cor_Submenu_NaoAtiva = '#0000FF';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#FFFFFF';
           break
       case 4 : // verde
		   cor_Menu_Ativa = '#5DA3B1';
		   cor_Menu_NaoAtiva = ''; 
		   cor_Fonte_Menu_Ativa = '#FFF';
		   cor_Fonte_Menu_NaoAtiva = '';
		   cor_Submenu_Ativa = '#5DA3B1';
		   cor_Submenu_NaoAtiva = '';
		   cor_Fonte_Submenu_Ativa = '#FFF';
		   cor_Fonte_Submenu_NaoAtiva = '';
           break
       case 5 : // vermelho
		   cor_Menu_Ativa = '#000000';
		   cor_Menu_NaoAtiva = '#FF0000'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#FFFFFF';
		   cor_Submenu_Ativa = '#000000';
		   cor_Submenu_NaoAtiva = '#FF0000';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#FFFFFF';
           break
       case 6 : // amarelo
		   cor_Menu_Ativa = '#000000';
		   cor_Menu_NaoAtiva = '#FFFF00'; 
		   cor_Fonte_Menu_Ativa = '#CCCCCC';
		   cor_Fonte_Menu_NaoAtiva = '#0000FF';
		   cor_Submenu_Ativa = '#000000';
		   cor_Submenu_NaoAtiva = '#FFFF00';
		   cor_Fonte_Submenu_Ativa = '#CCCCCC';
		   cor_Fonte_Submenu_NaoAtiva = '#0000FF';
           break
      case 7 : // laranja
		   cor_Menu_Ativa = '#FF9900';
		   cor_Menu_NaoAtiva = '#FFCC00'; 
		   cor_Fonte_Menu_Ativa = '#0000FF';
		   cor_Fonte_Menu_NaoAtiva = '#000000';
		   cor_Submenu_Ativa = '#FF9900';
		   cor_Submenu_NaoAtiva = '#FFCC00';
		   cor_Fonte_Submenu_Ativa = '#0000FF';
		   cor_Fonte_Submenu_NaoAtiva = '#000000';
           break
      case 8 : // marrom
		   cor_Menu_Ativa = '#993300';
		   cor_Menu_NaoAtiva = '#996600'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#FFFFFF';
		   cor_Submenu_Ativa = '#993300';
		   cor_Submenu_NaoAtiva = '#996600';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#FFFFFF';
           break
      case 9 : // naval
		   cor_Menu_Ativa = '#3399FF';
		   cor_Menu_NaoAtiva = '#99CCFF'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#000000';
		   cor_Submenu_Ativa = '#3399FF';
		   cor_Submenu_NaoAtiva = '#99CCFF';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#000000';
           break
       case 10 : // ouro
		   cor_Menu_Ativa = '#CC9900';
		   cor_Menu_NaoAtiva = '#CCCC33'; 
		   cor_Fonte_Menu_Ativa = '#000000';
		   cor_Fonte_Menu_NaoAtiva = '#FFFFFF';
		   cor_Submenu_Ativa = '#CC9900';
		   cor_Submenu_NaoAtiva = '#CCCC33';
		   cor_Fonte_Submenu_Ativa = '#000000';
		   cor_Fonte_Submenu_NaoAtiva = '#FFFFFF';
           break
       case 11 : // purpura
		   cor_Menu_Ativa = '#9900CC';
		   cor_Menu_NaoAtiva = '#CC00FF'; 
		   cor_Fonte_Menu_Ativa = '#000000';
		   cor_Fonte_Menu_NaoAtiva = '#FFFFFF';
		   cor_Submenu_Ativa = '#9900CC';
		   cor_Submenu_NaoAtiva = '#CC00FF';
		   cor_Fonte_Submenu_Ativa = '#000000';
		   cor_Fonte_Submenu_NaoAtiva = '#FFFFFF';
           break
       case 12 : // menu_xp
		   cor_Menu_Ativa = '#CCCCCC';
		   cor_Menu_NaoAtiva = '#D3E5FA'; 
		   cor_Fonte_Menu_Ativa = '#000000';
		   cor_Fonte_Menu_NaoAtiva = '#0A246A';
		   cor_Submenu_Ativa = '#1665CB';
		   cor_Submenu_NaoAtiva = '#FFFFFF';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#000000';
           if(moz || nav == 'Opera') {
               document.styleSheets[0].cssRules[2].style.border = 'none'; 
               document.styleSheets[0].cssRules[5].style.border = '1px solid #55A1FF'; 	 
               document.styleSheets[0].cssRules[7].style.border = 'none'; 	  		   
               document.styleSheets[0].cssRules[10].style.border = 'none'; 	  		   
		   }
		   else {
               document.styleSheets[0].rules[2].style.border = 'none'; 
               document.styleSheets[0].rules[5].style.border = '1px solid #55A1FF'; 	 
               document.styleSheets[0].rules[7].style.border = 'none'; 	  		   
               document.styleSheets[0].rules[10].style.border = 'none'; 	  		   
		   }
           break
       case 13 : // menu_office
		   cor_Menu_Ativa = '#C6D3EF';
		   cor_Menu_NaoAtiva = '#ECE9D8'; 
		   cor_Fonte_Menu_Ativa = '#000000';
		   cor_Fonte_Menu_NaoAtiva = '#000000';
		   cor_Submenu_Ativa = '#C6D3EF';
		   cor_Submenu_NaoAtiva = '#FFFFFF';
		   cor_Fonte_Submenu_Ativa = '#000000';
		   cor_Fonte_Submenu_NaoAtiva = '#000000';
           if(moz || nav == 'Opera') {
			   document.styleSheets[0].cssRules[2].style.border = 'none'; 
               document.styleSheets[0].cssRules[5].style.width = '156px'; 		   
               document.styleSheets[0].cssRules[5].style.border = '1px solid #8A867A';
			   document.styleSheets[0].cssRules[5].style.padding = '2px'; 	   	   		   
			   document.styleSheets[0].cssRules[9].style.border = '1px solid #8A867A'; 	
			   document.styleSheets[0].cssRules[9].style.padding = '2px';
		   }
		   else {
			   document.styleSheets[0].rules[2].style.border = 'none'; 
			   document.styleSheets[0].rules[5].style.border = '1px solid #8A867A';
			   document.styleSheets[0].rules[5].style.padding = '2px'; 	   	   		   
			   document.styleSheets[0].rules[9].style.border = '1px solid #8A867A'; 	
			   document.styleSheets[0].rules[9].style.padding = '2px';
		   }
           break
       case 14 : // met�lico
		   cor_Menu_Ativa = '#DCDAED';
		   cor_Menu_NaoAtiva = '#F3F2F9'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#000000';
		   cor_Submenu_Ativa = '#DCDAED';
		   cor_Submenu_NaoAtiva = '#F3F2F9';
		   cor_Fonte_Submenu_Ativa = '#0000FF';
		   cor_Fonte_Submenu_NaoAtiva = '#333333';
           if(moz || nav == 'Opera') {
               document.styleSheets[0].cssRules[2].style.height = '24px'; 
               document.styleSheets[0].cssRules[2].style.backgroundColor = '#FFFFFF'; 
               document.styleSheets[0].cssRules[2].style.border = '1px solid #666666'; 	   	   
               document.styleSheets[0].cssRules[2].style.backgroundImage = 'url(../img/fundo_01.jpg)';
	           document.styleSheets[0].cssRules[2].style.backgroundRepeat = 'repeat-x';
		   }
		   else {
               document.styleSheets[0].rules[2].style.height = '24px'; 
               document.styleSheets[0].rules[2].style.backgroundColor = '#FFFFFF'; 
               document.styleSheets[0].rules[2].style.border = '1px solid #666666'; 	   	   
               document.styleSheets[0].rules[2].style.backgroundImage = 'url(../img/fundo_01.jpg)';
	           document.styleSheets[0].rules[2].style.backgroundRepeat = 'repeat-x';
		   }			   
           break
       case 15 : // menu vista
		   cor_Menu_Ativa = '#DCDAED';
		   cor_Menu_NaoAtiva = '#F3F2F9'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#000000';
		   cor_Submenu_Ativa = '#DCDAED';
		   cor_Submenu_NaoAtiva = '#F3F2F9';
		   cor_Fonte_Submenu_Ativa = '#0000FF';
		   cor_Fonte_Submenu_NaoAtiva = '#333333';
           if(moz || nav == 'Opera') {
               document.styleSheets[0].cssRules[2].style.height = '24px'; 
               document.styleSheets[0].cssRules[2].style.width = '92px'; 		   
               document.styleSheets[0].cssRules[2].style.backgroundColor = '#FFFFFF'; 
               document.styleSheets[0].cssRules[2].style.border = 'none'; 	   	   
               document.styleSheets[0].cssRules[2].style.backgroundImage = 'url(../img/round10a.gif)';
	           document.styleSheets[0].cssRules[2].style.backgroundRepeat = 'repeat-x';
		   }
		   else {
               document.styleSheets[0].rules[2].style.height = '25px'; 
               document.styleSheets[0].rules[2].style.width = '92px'; 		   
               document.styleSheets[0].rules[2].style.backgroundColor = '#FFFFFF'; 
               document.styleSheets[0].rules[2].style.border = 'none'; 	   	   
               document.styleSheets[0].rules[2].style.backgroundImage = 'url(../img/round10a.gif)';
	           document.styleSheets[0].rules[2].style.backgroundRepeat = 'repeat-x';
		   }			   
           break
       default : //branco
		   cor_Menu_Ativa = '#000000';
		   cor_Menu_NaoAtiva = '#FFFFFF'; 
		   cor_Fonte_Menu_Ativa = '#FFFFFF';
		   cor_Fonte_Menu_NaoAtiva = '#999999';
		   cor_Submenu_Ativa = '#000000';
		   cor_Submenu_NaoAtiva = '#FFFFFF';
		   cor_Fonte_Submenu_Ativa = '#FFFFFF';
		   cor_Fonte_Submenu_NaoAtiva = '#999999';
           break
      }
}
