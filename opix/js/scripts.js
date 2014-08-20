var baseUrl = 'http://caminhoDoSite/opix/';

function habilitarExclusaoDeRegistros() {
	
	$(".icon-remove").parent().click(function(){
		var confirmado = confirm('Tem certeza que quer excluir?');
		if( confirmado ) {
			var id = $(this).attr('id').split('-');
			var controller = id[0];
			id = id[1];
			$.ajax({
				url : baseUrl + controller + '/excluir.html',
				type : 'POST',
				dataType : 'json',
				data : {
					id : id
				},
				success : function() {
					$('#'+controller+'-'+id).parents('tr, div.controls').effect('fade', null, 1000);
				}
			});
		}
	});
	
	
}

function habilitarTrocaDeStatus() {
	
	$(".icon-star, .icon-star-empty").parent().click(function(){
		var id = $(this).attr('id').split('-');
		var controller = id[0];
		id = id[1];
		$.ajax({
			url : baseUrl + controller + '/status.html',
			type : 'POST',
			dataType : 'json',
			data : {
				id : id
			},
			success : function() {
				window.location.href =  baseUrl + controller + '/listar.html';
			}
		});
	});
	
	
}

function habilitarTrocaDeConfirmacao() {
	$(".btn-confirmacao").click(function(){
		var confirmado = confirm('Tem certeza que quer confirmar/desconfirmar?');
		if( confirmado ) {
			var id = $(this).attr('id').split('-');
			var controller = id[0];
			id = id[1];
			$.ajax({
				url : baseUrl + controller + '/confirmacao.html',
				type : 'POST',
				dataType : 'json',
				data : {
					id : id
				},
				success : function() {
					window.location.reload();
				}
			});
		}
	});
}

function habilitarAdicionaRemoveInputFiles(){
	$("#add-input-file").on('click', function(){ 
		var files_group = $('#files-group'); 
		files_group.append('<div class="controls"><input type="file" class="input-large" name="imagem[]" /><input type="text" class="input-large" onfocus="if(this.value == \'\') this.value=\'http://\';" onblur="if(this.value == \'http://\') this.value=\'\';" name="link[]" /></div>'); 
	});
	
	$("#remove-input-file").on('click', function(){ 
		var files_group = $('#files-group');
		if( files_group.children('.controls:not(:has(input[type=hidden]))').length > 0 ) { 
			 files_group.children('.controls:not(:has(input[type=hidden]))').last().remove(); 
		} 
	});
}

function habilitarMoverCamposInputFilesPublicidade() {

	$("#files-group[sortable=sortable]").sortable({
		items : '> div[id^=item]',
		cursor : 'move',
		update : function( evento, elemento ) {
			var listaDeItens = $("#files-group[sortable=sortable]").sortable("toArray");
			listaDeItens.forEach(function(valor, indice) {
				$('#'+valor).find('input[name^=ordem]').val(indice + 1);
			});
			
		}
	});

}

function habilitarCampoCancel(){

	$('button[type=reset]').on('click', function(){
	
		var link = window.location.href;
		var controller = link.split('/')[5];
		var idNome = link.split('/')[7];
		if( isEmpty(idNome) ) {
			window.location.href=baseUrl + controller + '/listar.html';	
		} else {
			window.location.href=baseUrl + controller + '/listar/' + idNome;
		}
	
	});

}

$(document).ready(function(){
	
	habilitarExclusaoDeRegistros();
	habilitarTrocaDeStatus();
	habilitarTrocaDeConfirmacao();
	habilitarAdicionaRemoveInputFiles();
	habilitarMoverCamposInputFilesPublicidade();
	habilitarCampoCancel();
	
});
