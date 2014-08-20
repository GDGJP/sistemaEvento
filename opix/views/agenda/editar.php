<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Editar</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<input type="hidden" name="fkEvento" value="<?php echo $agenda->fkEvento; ?>" />
					<input type="hidden" name="id" value="<?php echo $agenda->id; ?>" />

					<div class="control-group">
						<label class="control-label" for="sala">Sala</label>
						<div class="controls">
							<select name="fkSala">
							<?php foreach($salas as $s) : ?>
							<?php 
							$selected = '';
							if($agenda->fkSala==$s->id) {
								$selected = 'selected="selected"';
							}
							?>
							<option <?php echo $selected; ?> value="<?php echo $s->id; ?>" ><?php echo $s->nome_pt; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="dia">Dia</label>
						<div class="controls">
							<select name="dia">
							<?php foreach($dias as $d) : ?>
							<?php 
							$selected = '';
							if($agenda->dia==Funcao::dateFormatToDatabase($d)) {
								$selected = 'selected="selected"';
							}
							?>

								<option <?php echo $selected; ?>  value="<?php echo $d; ?>" ><?php echo $d; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="hora_inicio">Hora Inincial</label>
						<div class="controls">
							<select name="hora_inicial">
							<?php foreach($horaInicial as $h) : ?>
							<?php 
							$selected = '';
							if($agenda->hora_inicial==$h) {
								$selected = 'selected="selected"';
							}
							?>
								<option <?php echo $selected; ?> value="<?php echo $h; ?>" ><?php echo $h; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="hora_fim">Hora Final</label>
						<div class="controls">
							<select name="hora_final">
							<?php foreach($horaFinal as $h) : ?>
							<?php 
							$selected = '';
							if($agenda->hora_final==$h) {
								$selected = 'selected="selected"';
							}
							?>
								<option <?php echo $selected; ?> value="<?php echo $h; ?>" ><?php echo $h; ?></option>
							<?php endforeach; ?>
							</select>	
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="cor">Cor</label>
						<div class="controls">
							<input style="background-color: #<?php echo $agenda->cor; ?>;"  name="cor" type="text" maxlength="6" size="6" id="colorpicker" value="<?php echo $agenda->cor; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="link">Link</label>
						<div class="controls">
							<input name="link" type="text" id="link" value="<?php echo $agenda->link; ?>" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="texto_pt">Texto (Português)</label>
						<div class="controls">
							<textarea class="ckeditor input-large" name="texto_pt" id="txto" ><?php echo $agenda->texto_pt; ?></textarea>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="texto_en">Texto (Inglês)</label>
						<div class="controls">
							<textarea class="ckeditor input-large" name="texto_en" id="txto" ><?php echo $agenda->texto_en; ?></textarea>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'agenda/listar/'.$agenda->fkEvento.'-evento'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
