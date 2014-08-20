<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione uma novo tipo de usuário</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-tipo-usuario" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" value="<?php echo $tipoUsuario->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="modulos">Módulos Permitidos</label>
						<div class="controls">
						<?php
							$modulos = Configuracao::$itensMenu;
							foreach( $modulos as $indice => $modulo ) {
						?>
								<input type="checkbox" class="input-large" name="modulos[]" value="<?php echo $indice; ?>" <?php echo in_array($indice, $tipoUsuario->modulos) ? 'checked="checked"' : ''; ?> /><?php echo $modulo['label']; ?>
						<?php 
							}
						?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'tipoUsuario/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
