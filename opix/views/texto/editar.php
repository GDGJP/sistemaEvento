<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o texto</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="titulo" >Título</label>
						<div class="controls">
							<input type="text" class="input-large" name="titulo" required="required" value="<?php echo $texto->titulo; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="texto">Texto</label>
						<div class="controls">
							<textarea <?php echo in_array($texto->id, array(4, 8, 11)) ? 'class="texto"' : ''; //habilita ckeditor só pra algun textos ?> name="texto" id="texto" ><?php echo $texto->texto; ?></textarea>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'texto/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
