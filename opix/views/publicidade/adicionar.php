<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione uma nova publicidade</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-publicidade" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" />
						</div>
					</div>
					<div class="control-group" id="files-group">
						<label class="control-label" for="imagem">Imagens</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem[]" />
							<input type="text" class="input-large url" name="link[]" />
						</div>
						<div class="controls">
							<input type="file" class="input-large" name="imagem[]" />
							<input type="text" class="input-large url" name="link[]" />
						</div>
						<div class="controls">
							<input type="file" class="input-large" name="imagem[]" />
							<input type="text" class="input-large url" name="link[]" />
						</div>
						<div class="controls">
							<input type="file" class="input-large" name="imagem[]" />
							<input type="text" class="input-large url" name="link[]" />
						</div>
					</div>
					<div class="control-group">
						<div class="controls" >
							<a href="javascript:void(0);" id="add-input-file" >Adicionar</a>
							<a href="javascript:void(0);" id="remove-input-file" >Remover</a>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'publicidade/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
