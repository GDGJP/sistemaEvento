<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicionar</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<input id="evento" type="hidden" name="fkEvento" value="<?php echo $_GET['id']; ?>" />

					<div class="control-group">
						<label class="control-label" for="sala">Sala</label>
						<div class="controls">
							<select onchange="limpaTudo();" name="fkSala" id="sala" >
							<?php foreach($salas as $s) : ?>
								<option   value="<?php echo $s->id; ?>" ><?php echo $s->nome_pt; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dia">Dia</label>
						<div class="controls">
							<select onchange="horasVagas(this.value);" name="dia" id="dia" >
								<option value="" >Selecione</option>
							<?php foreach($dias as $d) : ?>
								<option  value="<?php echo $d; ?>" ><?php echo $d; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="hora_inicio">Hora Inicial</label>
						<div class="controls">
							<select onchange="horasVagas2(this.value)" name="hora_inicial" id="hora_inicial" >
								<option value="" >Selecione uma data </option>
							</select>
						</div>
					</div>
<script>
function limpaTudo() {
	$('#hora_inicial').html('<option value="" >Selecione uma data </option>');
	$('#hora_final').html('<option value="" >Selecione uma hora inicial</option>');
	$("#dia option:first").attr('selected','selected');
}
function horasVagas(dia) {
	$('#hora_final').html('<option value="" >Selecione uma hora inicial</option>');
	evento = $('#evento').val();
	sala   = $('select#sala option:selected').val();
	action = '../horasVagas.html';
	$.ajax({
		url : action,
		type: 'POST',
		dataType: 'json',
		data : ({'evento': evento,'sala':sala,'data':dia}),
		success: function(data) {
			var resp;
			for(i=0; i < data.length; i++){
				resp += '<option value="'+data[i]+'" >'+data[i]+'</option>';
			}
			$('#hora_inicial').html(resp);
		}
	});
}

function horasVagas2(hora) {
	data   = $('select#dia option:selected').val();
	evento = $('#evento').val();
	sala   = $('select#sala option:selected').val();
	action = '../horasVagasSemQuebrarSeguencia.html';
	$.ajax({
		url : action,
		type: 'POST',
		dataType: 'json',
		data : ({'evento': evento,'sala':sala,'data':data}),
		success: function(data) {
			var resp;
			for(i=0; i < data.length; i++){
				if(data[i] <= hora) { continue; }
				resp += '<option value="'+data[i]+'" >'+data[i]+'</option>';
			}
			$('#hora_final').html(resp);
		}
	});
}

</script>
					<div class="control-group">
						<label class="control-label" for="hora_fim">Hora Final</label>
						<div class="controls">
							<select name="hora_final" id="hora_final" >
								<option value="" >Selecione uma hora inicial </option>
							</select>	
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="cor">Cor</label>
						<div class="controls">
							<input name="cor" type="text" maxlength="6" size="6" id="colorpicker" value="ffffff" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="link">Link</label>
						<div class="controls">
							<input name="link" type="text" id="link" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="texto_pt">Texto (Português)</label>
						<div class="controls">
							<textarea class="ckeditor input-large texto " name="texto_pt" id="txto" ></textarea>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="texto_pt">Texto (Inglês)</label>
						<div class="controls">
							<textarea class="ckeditor input-large texto" name="texto_en" id="txto" ></textarea>
						</div>
					</div>
				
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'agenda/listar/'.$_GET['id'].'-evento'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
