function habilitarValidacaoFormularioUsuario() {
	var rules = {
		rules : {
			'nome' : 'required',
			'email' : {
				required : true,
				email : true
			},
			'confirma_senha' : {
				equalTo : '#senha'
			},
			'emailNotificacao' : {
				required : true,
				email : true
			}
		},
		messages : {
			'nome' : 'O campo nome é obrigatório',
			'email' : {
				required : 'O campo email é obrigatório',
				email : 'Por favor, digite um email válido'
			},
			'sexo' : 'O campo sexo é obrigatório',
			'emailNotificacao' : {
				required : 'O campo Email de Notificação é obrigatório',
				email : 'Por favor, digite um email de notificação válido'
			},
			'confirma_senha' : {
				equalTo : 'Os campos senha e confirmação de senha devem coincidir'
			}
		}
	};
			
	var validationObj = $.extend (rules, Application.validationRules);
	
	$('#validation-form-usuario').validate(validationObj);
}

function habilitarValidacaoFormularioEvento() {
	var rules = {
		rules : {
			'Event\[nome\]' : 'required',
			'Event\[dataInicio\]' : 'required',
			'Event\[dataFim\]' : 'required',
			'Event\[categoria\]' : 'required',
			'Event\[descricao\]' : 'required',
			'Event\[cep\]' : 'required',
			'Event\[endereco\]' : 'required',
			'Event\[numero\]' : 'required',
			'Event\[bairro\]' : 'required',
			'Event\[cidade\]' : 'required',
			'Event\[estado\]' : 'required'
		},
		messages : {
			'Event\[nome\]' : 'O campo \'nome\' é obrigatório',
			'Event\[dataInicio\]' : 'O campo \'data de início\' é obrigatório',
			'Event\[dataFim\]' : 'O campo \'data de término\' é obrigatório',
			'Event\[categoria\]' : 'O campo \'categoria\' é obrigatório',
			'Event\[descricao\]' : 'O campo \'programação\' é obrigatório',
			'Event\[cep\]' : 'O campo \'local\' é obrigatório',
			'Event\[endereco\]' : 'O campo \'endereço\' é obrigatório',
			'Event\[numero\]' : 'O campo \'número\' é obrigatório',
			'Event\[bairro\]' : 'O campo \'bairro\' é obrigatório',
			'Event\[cidade\]' : 'O campo \'cidade\' é obrigatório',
			'Event\[estado\]' : 'O campo \'estado\' é obrigatório'
		}
	};
			
	var validationObj = $.extend (rules, Application.validationRules);
	
	$('#validation-form-evento').validate(validationObj);
}

function habilitarValidacaoFormularioPublicidade() {
	var rules = {
		rules : {
			'nome' : 'required'
		},
		messages : {
			'nome' : 'O campo nome é obrigatório'
		}
	};
			
	var validationObj = $.extend (rules, Application.validationRules);
	
	$('#validation-form-publicidade').validate(validationObj);
}

function habilitarValidacaoFormularioNovoUsuario() {
	var rules = {
		rules : {
			'nome' : 'required',
			'email' : {
				required : true,
				email : true
			},
			'sexo' : 'required',
			'tipo' : 'required',
			'senha_confirma' : {
				equalTo: '#senha'
			}
		},
		messages : {
			'nome' : 'O campo nome é obrigatório',
			'email' : {
				required : 'O campo email é obrigatório',
				email : 'Por favor, digite um email válido'
			},
			'sexo' : 'O campo sexo é obrigatório',
			'senha_confirma' : {
				equalTo : 'Os campos senha e confirmação de senha devem coincidir'
			}
		}
	};
			
	var validationObj = $.extend (rules, Application.validationRules);
	
	$('#validation-form-new-usuario').validate(validationObj);
}

$(document).ready(function() {
	$.validator.addMethod("notEqual", function(value, element, param) {
	  return this.optional(element) || value != param;
	}, "Please specify a different (non-default) value");

	habilitarValidacaoFormularioUsuario();
	habilitarValidacaoFormularioEvento();
	habilitarValidacaoFormularioPublicidade();
	habilitarValidacaoFormularioNovoUsuario();

});
