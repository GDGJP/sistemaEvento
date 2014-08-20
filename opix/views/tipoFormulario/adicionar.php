<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione uma novo tipo de formulário</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-tipo-usuario" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							Certificado <input type="checkbox" class="input-large" name="certificado" value="1" <?php echo ($tipoFormulario->certificado == 1) ? 'checked="checked"' : ''; ?> />
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'tipoFormulario/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
