<?php
	if( empty($_GET['e']) )
		unset($_SESSION['dados']);
	if( isset($_SESSION['dados']) ) {
		$dados = $_SESSION['dados'];
	}
?>
<script type="text/javascript" >
	document.ready = function() {
		<?php if(!isset($dados)) : ?>
		    $("form").find('input, select').val('');
		<?php else : ?>
	        $("#estado").trigger('change');
	        $("#cidade").val('<?php echo $dados['cidade']; ?>');
		<?php endif; ?>

		$('.telefone').focusout(function(){
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
				e.stopPropagation();
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

		$("#cep").blur(function(){
			$.ajax({
				url : 'getInformacoesPorCep.html',
				type : 'POST',
				data : {
					cep : $(this).val()
				},
				async: false,
				dataType : 'json',
				success : function(resposta) {
					if( resposta.resposta != false ) {
						$("#estado").val(resposta.estado).trigger("change");
						$("#cep").val(resposta.cep);
						if( resposta.logradouro != '' ) {
							$("#logradouro").val(resposta.logradouro);
						}
						if( resposta.bairro != '' ) {
							$("#bairro").val(resposta.bairro);
						}
						$("#cidade").val(resposta.cidade);
						$("#numero").focus();
					}
				}
			});
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
					data = data[0];
					$("#nome").val(data.nome);
					$("#email").val(data.email1);
					$("#rg").val(data.rg.split(' ')[0]);
					$("#orgao_emissor").val(data.rg.split(' ')[1]);
					$("#sexo").val(data.sexo.toLowerCase());
					var data_nascimento = data.dataNascimento.split('-');
					$("#data_nascimento").val(data_nascimento[2]+'/'+data_nascimento[1]+'/'+data_nascimento[0]);
				}
			});
			return false;
		}

	}
</script>
<div class="container">
<div class="marketing">
	<h2>Inscrição</h2>
	<p class="marketing-byline"><?php echo $texto->texto; ?><br /><span style="color:red;" >Taxa de inscrição: R$ 70,00</span></p>

	<div class="row-fluid">
	<div class="span10">

		<form class="form-horizontal" method="POST" name="formulario" >
		<fieldset>

		<!-- Form Name -->
		<legend>Formulário de Inscrição</legend>

		<p>Por favor, preencha o formulário abaixo.</p>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="nome">Nome</label>
		<div class="controls">
			<input id="nome" name="nome" placeholder="" class="input-xlarge" required="required" type="text" <?php echo (!empty($dados['nome'])) ? 'value="'.$dados['nome'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'nr|') !== false ) : ?>
				<label for="nome" class="error">O campo 'Nome' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="funcao">Categoria</label>
		<div class="controls">
			<select id="funcao" name="funcao" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaFuncoes as $indice => $label) : ?>
					<option <?php echo (!empty($dados['funcao']) && $dados['funcao'] == $indice ) ? 'required="required"' : ''; ?> value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'fu|') !== false ) : ?>
				<label for="funcao" class="error">O campo 'Categoria' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="email">E-mail</label>
		<div class="controls">
			<input id="email" name="email" class="input-xlarge" required="required" type="email" <?php echo (!empty($dados['email'])) ? 'value="'.$dados['email'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'er|') !== false ) : ?>
				<label for="email" class="error">O campo 'Email' é obrigatório</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ei|') !== false ) : ?>
				<label for="email" class="error">O Email digitado está incorreto. Por favor, verifique-o</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ee|') !== false ) : ?>
				<label for="email" class="error">O Email já está cadastrado. Por favor, escolha outro</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="telefone">Telefone</label>
		<div class="controls">
			<input id="telefone" name="telefone" pattern="[\(]\d{2}[\)]\ \d{4,5}[\-]\d{4}" class="input-xlarge telefone" required="required" type="text" <?php echo (!empty($dados['telefone'])) ? 'value="'.$dados['telefone'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'tr|') !== false ) : ?>
				<label for="telefone" class="error">O campo 'Telefone' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="data_nascimento">Data de Nascimento</label>
		<div class="controls">
			<input id="data_nascimento" name="data_nascimento" data-mask="99/99/9999" pattern="\d{2}[\/]\d{2}[\/]\d{4}" class="input-xlarge" required="required" type="text" <?php echo (!empty($dados['data_nascimento'])) ? 'value="'.$dados['data_nascimento'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'dnr|') !== false ) : ?>
				<label for="data_nascimento" class="error">O campo 'Data de Nascimento' é obrigatório</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'dni|') !== false ) : ?>
				<label for="data_nascimento" class="error">A data de nascimento digitada está incorreta. Por favor, verifique-a</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="sexo">Sexo</label>
		<div class="controls">
			<select id="sexo" name="sexo" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaSexos as $indice => $label) : ?>
					<option <?php echo (!empty($dados['sexo']) && $dados['sexo'] == $indice ) ? 'required="required"' : ''; ?> value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'sr|') !== false ) : ?>
				<label for="sexo" class="error">O campo 'Sexo' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="cpf">CPF</label>
		<div class="controls">
			<input id="cpf" name="cpf" data-mask="999.999.999-99" pattern="\d{3}[\.]\d{3}[\.]\d{3}[\-]\d{2}" class="input-xlarge" type="text" required="required" <?php echo (!empty($dados['cpf'])) ? 'value="'.$dados['cpf'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'cr|') !== false ) : ?>
				<label for="cpf" class="error">O campo 'Cpf' é obrigatório</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ci|') !== false ) : ?>
				<label for="cpf" class="error">O Cpf digitado está incorreto. Por favor, verifique-o</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ce|') !== false ) : ?>
				<label for="cpf" class="error">O Cpf já está cadastrado. Por favor, escolha outro</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="rg">RG</label>
		<div class="controls">
			<input id="rg" name="rg" class="input-xlarge" type="text" <?php echo (!empty($dados['rg'])) ? 'value="'.$dados['rg'].'"' : ''; ?> >
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="orgao_emissor">Orgão Emissor</label>
		<div class="controls">
			<input id="orgao_emissor" name="orgao_emissor" class="input-xlarge" type="text" <?php echo (!empty($dados['orgao_emissor'])) ? 'value="'.$dados['orgao_emissor'].'"' : ''; ?> >
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="cep">CEP</label>
		<div class="controls">
			<input id="cep" name="cep" data-mask="99999-999" pattern="\d{5}[\-]\d{3}" class="input-xlarge" type="text" <?php echo (!empty($dados['cep'])) ? 'value="'.$dados['cep'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'cei|') !== false ) : ?>
				<label for="cep" class="error">O Cep digitado está incorreto. Por favor, verifique-o</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="estado">Estado</label>
		<div class="controls">
			<select id="estado" name="estado" required="required" >
				<option value="">Selecione</option>
				<?php foreach($listaEstados as $estado) : ?>
					<option <?php echo (!empty($dados['estado']) && $dados['estado'] == $estado->id ) ? 'required="required"' : ''; ?> value="<?php echo $estado->id; ?>" ><?php echo $estado->nome; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'esr|') !== false ) : ?>
				<label for="estado" class="error">O campo 'Estado' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="cidade">Cidade</label>
		<div class="controls">
			<select id="cidade" name="cidade" required="required" >
				<option value="" >Primeiro selecione o estado acima</option>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'cir|') !== false ) : ?>
				<label for="cidade" class="error">O campo 'Cidade' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="bairro">Bairro</label>
		<div class="controls">
			<input id="bairro" name="bairro" class="input-xlarge" required="required" type="text" <?php echo (!empty($dados['bairro'])) ? 'value="'.$dados['bairro'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'br|') !== false ) : ?>
				<label for="estado" class="error">O campo 'Bairro' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="logradouro">Logradouro</label>
		<div class="controls">
			<input id="logradouro" name="logradouro" class="input-xlarge" required="required" type="text" <?php echo (!empty($dados['logradouro'])) ? 'value="'.$dados['logradouro'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'lr|') !== false ) : ?>
				<label for="logradouro" class="error">O campo 'Logradouro' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="numero">Número</label>
		<div class="controls">
			<input id="numero" name="numero" pattern="\d+" class="input-xlarge" type="text" required="required" <?php echo (!empty($dados['numero'])) ? 'value="'.$dados['numero'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'nr|') !== false ) : ?>
				<label for="numero" class="error">O campo 'Número' é obrigatório</label>
			<?php endif; ?>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ni|') !== false ) : ?>
				<label for="numero" class="error">O Número digitado está incorreto. Por favor, verifique-o e digite apenas números</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="complemento">Complemento</label>
		<div class="controls">
			<input id="complemento" name="complemento" class="input-xlarge" type="text" <?php echo (!empty($dados['complemento'])) ? 'value="'.$dados['complemento'].'"' : ''; ?> >
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		<label class="control-label" for="instituicao">Instituição</label>
		<div class="controls">
			<input id="instituicao" name="instituicao" class="input-xlarge" type="text" required="required" <?php echo (!empty($dados['instituicao'])) ? 'value="'.$dados['instituicao'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ir|') !== false ) : ?>
				<label for="instituicao" class="error">O campo 'Instituição' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

    <div class="control-group" >
		<label class="control-label" for="voucher">Voucher</label>
		<div class="controls">
			<input id="voucher" name="voucher" class="input-xlarge" type="text" <?php echo (!empty($dados['voucher'])) ? 'value="'.$dados['voucher'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'vch|') !== false ) : ?>
				<label for="voucher" class="error">Voucher inválido.</label>
			<?php endif; ?>
      <?php if( isset($_GET['e']) && strpos($_GET['e'], 'vch2|') !== false ) : ?>
				<label for="voucher" class="error">Voucher já usado.</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="area_atuacao">Área de Atuação</label>
		<div class="controls">
			<select id="area_atuacao" name="area_atuacao" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaAreasAtuacao as $indice => $label) : ?>
					<option <?php echo (!empty($dados['area_atuacao']) && $dados['area_atuacao'] == $indice ) ? 'required="required"' : ''; ?> value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'ar|') !== false ) : ?>
				<label for="area_atuacao" class="error">O campo 'Área de Atuação' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="profissao">Profissão</label>
		<div class="controls">
			<select id="profissao" name="profissao" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaProfissoes as $profissao) : ?>
					<option <?php echo (!empty($dados['profissao']) && $dados['profissao'] == $profissao->id ) ? 'required="required"' : ''; ?> value="<?php echo $profissao->id; ?>" ><?php echo $profissao->nome; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'pr|') !== false ) : ?>
				<label for="profissao" class="error">O campo 'Profissão' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Text input-->
		<div class="control-group" style="display: none;">
		<label class="control-label" for="outra_profissao">Outra Profissão</label>
		<div class="controls">
			<input id="outra_profissao" name="outra_profissao" class="input-xlarge" type="text" <?php echo (!empty($dados['outra_profissao'])) ? 'value="'.$dados['outra_profissao	'].'"' : ''; ?> >
			<?php if( isset($_GET['e']) && $dados['profissao'] == 770 && strpos($_GET['e'], 'opr|') !== false ) : ?>
				<label for="outra_profissao" class="error">O campo 'Outra Profissão' nesse caso é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="grau_instrucao">Grau de Instrução</label>
		<div class="controls">
			<select id="grau_instrucao" name="grau_instrucao" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaGrausInstrucao as $indice => $label) : ?>
					<option <?php echo (!empty($dados['grau_instrucao']) && $dados['grau_instrucao'] == $indice ) ? 'required="required"' : ''; ?> value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'gir|') !== false ) : ?>
				<label for="grau_instrucao" class="error">O campo 'Grau de Instrução' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Select -->
		<div class="control-group">
		<label class="control-label" for="tamanho_camisa">Tamanho da Camisa</label>
		<div class="controls">
			<select id="tamanho_camisa" name="tamanho_camisa" required="required" >
				<option value="" >Selecione</option>
				<?php foreach($listaTamanhosCamisa as $indice => $label) : ?>
					<option <?php echo (!empty($dados['tamanho_camisa']) && $dados['tamanho_camisa'] == $indice ) ? 'required="required"' : ''; ?> value="<?php echo $indice; ?>" ><?php echo $label; ?></option>
				<?php endforeach; ?>
			</select>
			<?php if( isset($_GET['e']) && strpos($_GET['e'], 'tcr|') !== false ) : ?>
				<label for="tamanho_camisa" class="error">O campo 'Tamanho de Camisa' é obrigatório</label>
			<?php endif; ?>
		</div>
		</div>

		<!-- Button -->
		<div class="control-group">
		<label class="control-label" for="singlebutton"></label>
		<div class="controls">
			<button id="singlebutton" name="singlebutton" class="btn btn-info">Cadastrar</button>
		</div>
		</div>

		</fieldset>
		</form>

	</div>

</div>
</div>
</div>

