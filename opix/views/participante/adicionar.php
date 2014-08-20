<script type="text/javascript" src="<?php echo Configuracao::$baseUrl.'../arquivos/str_pad.js'; ?>" ></script>
<script type="text/javascript" >
	document.ready = function() {

		$.getScript('<?php echo Configuracao::$baseUrl; ?>../arquivos/jasny-bootstrap.min.js');
		$.getScript("<?php echo Configuracao::$baseUrl; ?>../arquivos/jquery.maskedinput.min.js");

		$("form").find('input[type!=button], select').val('');

		$('#telefone').focusout(function(){
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

		//Confirmar Email
		$('#email').blur(function(e){
			$.ajax({
				url : 'confirmaEmail.html',
				type: 'POST',
				dataType: 'json',
				data : ({'email': $(this).val()}),
				success: function(existe) {
					if(existe) {
						alert('Email cadastrado no sistema, escolha outro.');
						e.stopPropagation();
						$('#email').focus();
					}
				}
			});
		});

		$('#cpf').blur(function(e) {

			cpf = $('#cpf').val();
			cpf = cpf.replace(/[^\d]+/g,'');

			error = 0;
			if(cpf == '') {
				error = 1;
			}

			// Elimina CPFs invalidos conhecidos
			if (cpf.length != 11 ||
				cpf == "00000000000" ||
				cpf == "11111111111" ||
				cpf == "22222222222" ||
				cpf == "33333333333" ||
				cpf == "44444444444" ||
				cpf == "55555555555" ||
				cpf == "66666666666" ||
				cpf == "77777777777" ||
				cpf == "88888888888" ||
				cpf == "99999999999") {
				error = 1;
			}

			// Valida 1o digito
			add = 0;
			for (i=0; i < 9; i ++)
				add += parseInt(cpf.charAt(i)) * (10 - i);
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cpf.charAt(9))) {
				error = 1;
			}

			// Valida 2o digito
			add = 0;
			for (i = 0; i < 10; i ++)
				add += parseInt(cpf.charAt(i)) * (11 - i);
			rev = 11 - (add % 11);
			if (rev == 10 || rev == 11)
				rev = 0;
			if (rev != parseInt(cpf.charAt(10))) {
				error = 1;
			}
			if(error) {
				alert('Verifique o CPF.');
				e.stopPropagation();
				$("#cpf").focus();
				return false;
			}

			$.ajax({
				url : 'confirmaCpf.html',
				type: 'POST',
				dataType: 'json',
				data : ({'cpf': $(this).val()}),
				success: function(existe) {
					if(existe == 1) {
						alert('Cpf cadastrado no sistema, escolha outro.');
						e.stopPropagation();
						$('#cpf').focus('');
					}
				}
			});

			testaUsuario($(this).val());
		});

		$("#data_nascimento").blur(function(e){

			var data = $(this).val().split("/");
			var erro = 0;
			var dataAtual = new Date();

			if( data == '' ) {
				alert('Preencha o campo "Data de nascimento"');
				$("#data_nascimento").focus();
				return false;
			}

			if( data[0] > 31 ) {
				erro = 1;
			} else if( $.inArray(data[1], [2, 4, 6, 9, 11]) && data[0] > 30 ) {
				erro = 1;
			} else if( data[1] == 2 && data[0] > 29 ) {
				erro = 1;
			} else if( data[2].toString()+data[1].toString()+data[0].toString() > dataAtual.getFullYear().toString()+str_pad(dataAtual.getMonth() + 1, 2, 0, 'STR_PAD_LEFT').toString()+dataAtual.getDate().toString() ) {
				erro = 1;
			} else {
				erro = 0;
			}

			if( erro ) {
				alert('Data de nascimento inválida');
				$("#data_nascimento").focus();
			}
		});

		$("#estado").change(function(){
			$.ajax({
				url : 'getCidades.html',
				type : 'POST',
				async: false,
				data : {
					estado : $(this).val()
				},
				dataType : 'html',
				success : function(cidades) {
					$("#cidade").html(cidades);
				}
			});
		});

		$("#botao_cep").click(function(){
			$.ajax({
				url : 'getInformacoesPorCep.html',
				type : 'POST',
				data : {
					cep : $('#cep_participante').val()
				},
				async: false,
				dataType : 'json',
				success : function(resposta) {
					if( resposta.resposta != false ) {
						$("#estado").val(resposta.estado).trigger('change');
						$("#cep_participante").val(resposta.cep);
						if( resposta.logradouro != '' ) {
							$("#logradouro").val(resposta.logradouro);
						}
						if( resposta.bairro != '' ) {
							$("#bairro").val(resposta.bairro);
						}
						$("#cidade").val(resposta.cidade);
						$("#estado").val(resposta.estado);
						$("#cidade").val(resposta.cidade);
						$("#numero").focus();
					}
				}
			});

			return false;
		});

		$("#profissao").change(function(){
			if( $(this).val() == 770 ) {
				$("#outra_profissao").attr('required', "required");
				$("#outra_profissao").parent().parent().slideDown(1000);
			} else {
				$("#outra_profissao").removeAttr('required');
				$("#outra_profissao").parent().parent().slideUp(1000);
			}
		});

		function testaUsuario(id) {
			var action = 'http://www.anid.com.br/aniderp/jsonWs.php';
			var values = {id: id, l:1};
			$.ajax({
				url : action,
				type: 'POST',
				dataType: 'json',
				data: values,
				success: function(data) {
					if( typeof data != 'number' ) {
						data = data[0];
						$("#nome").val(data.nome);
						$("#email").val(data.email1);
						$("#rg").val(data.rg.split(' ')[0]);
						$("#orgao_emissor").val(data.rg.split(' ')[1]);
						$("#sexo").val(data.sexo.toLowerCase());
						var data_nascimento = data.dataNascimento.split('-');
						$("#data_nascimento").val(data_nascimento[2]+'/'+data_nascimento[1]+'/'+data_nascimento[0]);
					}
				}
			});
			return false;
		}

	}
</script>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione um novo participante</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="nome" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="funcao">Função</label>
						<div class="controls">
							<select required="required" name="funcao">
							<?php foreach($listaFuncoes as $indice => $label) : ?>
								<option value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email" >Email</label>
						<div class="controls">
							<input type="email" class="input-large" required="required" name="email" id="email" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="telefone" >Telefone</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="telefone" id="telefone" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="data_nascimento" >Data de Nascimento</label>
						<div class="controls">
							<input type="text" data-mask="99/99/9999" class="input-large" required="required" name="data_nascimento" id="data_nascimento" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="sexo">Sexo</label>
						<div class="controls">
							<select required="required" name="sexo">
							<?php foreach($listaSexos as $indice => $label) : ?>
								<option value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cpf" >CPF</label>
						<div class="controls">
							<input type="text" data-mask="999.999.999-99" class="input-large" required="required" name="cpf" id="cpf" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="rg" >RG</label>
						<div class="controls">
							<input type="text" class="input-large" name="rg" id="rg" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="orgao_emissor" >Orgão Emissor</label>
						<div class="controls">
							<input type="text" class="input-large" name="orgao_emissor" id="orgao_emissor" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="CEP" >CEP</label>
						<div class="controls">
							<input type="text" data-mask="99999-999" class="input-large" name="cep" id="cep_participante" />
							<input type="button" class="btn" id="botao_cep" value="Buscar cep" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="estado">Estado</label>
						<div class="controls">
							<select required="required" name="estado" id="estado">
							<option value="">Selecione</option>
							<?php foreach($listaEstados as $estado) : ?>
								<option value="<?php echo $estado->id; ?>" ><?php echo $estado->nome; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="cidade">Cidade</label>
						<div class="controls">
							<select required="required" name="cidade" id="cidade">
								<option value="" >Primeiro selecione o estado</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="bairro" >Bairro</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="bairro" id="bairro" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="logradouro" >Logradouro</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="logradouro" id="logradouro" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="numero" >Número</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="numero" id="numero" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="complemento" >Complemento</label>
						<div class="controls">
							<input type="text" class="input-large" name="complemento" id="complemento" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="instituicao" >Instituição</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="instituicao" id="instituicao" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="area_atuacao">Área de Atuação</label>
						<div class="controls">
							<select required="required" name="area_atuacao">
							<?php foreach($listaAreasAtuacao as $indice => $label) : ?>
								<option value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="profissao">Profissão</label>
						<div class="controls">
							<select required="required" name="profissao">
							<?php foreach($listaProfissoes as $profissao) : ?>
								<option value="<?php echo $profissao->id; ?>" ><?php echo $profissao->nome; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group" style="display:none;">
						<label class="control-label" for="outra_profissao">Outra Profissão</label>
						<div class="controls">
							<input type="text" class="input-large" name="outra_profissao" id="outra_profissao" value="<?php echo $participante->outra_profissao; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="grau_instrucao">Grau de Instrução</label>
						<div class="controls">
							<select required="required" name="grau_instrucao">
							<?php foreach($listaGrausInstrucao as $indice => $label) : ?>
								<option value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tamanho_camisa">Tamanho da Camisa</label>
						<div class="controls">
							<select required="required" name="tamanho_camisa">
							<?php foreach($listaTamanhosCamisa as $indice => $label) : ?>
								<option value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'noticia/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
