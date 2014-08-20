function habilitarMascaraCamposMonetarios( classes ){
	
	classes.forEach(function(classe){
		$(classe).maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
	});
	
}

function habilitarMascaraCamposCep( classes ) {
	
	classes.forEach(function(classe){
		$(classe).mask('99999-999');
	});
	
}

function habilitarMascaraCamposData() {
	
	$('.dataMinima' ).datepicker({altFormat: "mm-dd-yy", dateFormat: "dd/mm/yy", beforeShow : function(){
		if( !isEmpty($(".dataMaxima[rel="+$(this).attr('rel')+"]").datepicker("getDate")) ) {
			$(this).datepicker("option", "maxDate", $(".dataMaxima[rel="+$(this).attr('rel')+"]").datepicker("getDate"));
		}
	}});
	
	$('.dataMaxima' ).datepicker({altFormat: "mm-dd-yy", dateFormat: "dd/mm/yy", beforeShow : function(){
		if( !isEmpty($(".dataMinima[rel="+$(this).attr('rel')+"]").datepicker("getDate")) ) {
			$(this).datepicker("option", "minDate", $(".dataMinima[rel="+$(this).attr('rel')+"]").datepicker("getDate"));
		}
	}});
	
}

function habilitarMascaraCpfCnpj() {
	
	$("input[name=selecionaCpfCnpj]").click(function(){
		
		if( $("input[name=selecionaCpfCnpj]:checked").val() == "cpf" ) {
			$(".cpfCnpj").mask("999.999.999-99");
		} else {
			$(".cpfCnpj").mask("99.999.999/9999-99");
		}
		
		$(".cpfCnpj").focus();
		
	});
	
	$("input[name=selecionaCpfCnpj]:checked").click();
	
}

function habilitarMascaraCampoUrl(classes) {

	classes.forEach(function(classe){
		$(classe).focus(function(){
			if( $(this).val() == '' ) {
				$(this).val('http://');
			}
		});
		
		$(classe).blur(function(){
			if( $(this).val() == 'http://' ) {
				$(this).val('');
			}
		});
	});

}

function habilitarMascaraCamposCpf( classes ) {
	
	classes.forEach(function(classe){
		$(classe).mask('999.999.999-99');
	});
	
}

function habilitarMascaraCamposTelefone( classes ) {
	
	classes.forEach(function(classe){
		$(classe).focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99) 99999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
		}).trigger('focusout');
	});
	
}


$(document).ready(function(){
	
	habilitarMascaraCamposMonetarios(['.valor']);
	habilitarMascaraCamposCep(['.cep']);
	habilitarMascaraCamposData();
	habilitarMascaraCpfCnpj();
	habilitarMascaraCampoUrl(['.url']);
	habilitarMascaraCamposCpf(['.cpf']);
	habilitarMascaraCamposTelefone(['.telefone']);
	
});
