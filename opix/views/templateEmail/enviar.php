<?php if( $idFormulario == 17 ) : ?>
<script type="text/javascript" >
	document.ready = function() {
		$('#filtroParticipantes').change(function(){
			$.ajax({
				url : '<?php echo Configuracao::$baseUrl; ?>participante/filtros<?php echo Configuracao::$extensaoPadrao; ?>',
				type : 'POST',
				data : {
					tipo : $(this).val(),
					formulario : <?php echo $idFormulario; ?>
				},
				dataType : 'html',
				success : function(data) {
					$("#validation-form").find('.control-group').html(data);
				}
			});	
		});
		
		$('#filtroParticipantes').trigger('change');
	};
</script>
<?php endif; ?>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Marque os participantes que receberão seu email</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<?php if($idFormulario == 17) : ?>
				<div style="float:left; width:100%; margin: -2% 0 0 0;" >
					<select style="width:100%;" id="filtroParticipantes" >
						<option value="todos" >Todos</option>
						<option value="sem-foto" >Apenas os que não enviaram foto</option>
						<option value="so-aprovados" >Apenas os aprovados</option>
						<option value="cpfs-invalidos" >Apenas com cpf inválido</option>
						<option selected="selected" value="so-aprovados-sem-foto" >Apenas os aprovados que não enviaram fotos</option>
					</select>
				</div>
			<?php endif; ?>
			<br />
			<form method="post" action="" id="validation-form" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<?php
							foreach( $participantes as $participante ) {
								$objetoParticipante = json_decode($participante->respostas);
								$arrayParticipante = get_object_vars($objetoParticipante);
								$arrayParticipante = array_values($arrayParticipante);
						?>
							<input type="checkbox" name="participantes[]" value="<?php echo $participante->id; ?>" /><?php echo $arrayParticipante[3]; ?>&lt;<?php echo $arrayParticipante[7]; ?>&gt;<br />
						<?php
							}
						?>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Enviar</button>&nbsp;&nbsp;
						<button type="button" class="btn buttonControlCheck">Marcar Todos</button>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
