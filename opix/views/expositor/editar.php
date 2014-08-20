<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o expositor</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="nome" value="<?php echo $expositor->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="link" >Link</label>
						<div class="controls">
							<input type="text" class="input-large url" name="link" value="<?php echo $expositor->link; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="imagem">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem" />
							<?php if( !empty($expositor->imagem) && file_exists(__DIR__.'/../../../expositores/'.$expositor->imagem) ) : ?>
							    <br /><br />
								<img src="<?php echo Configuracao::$baseUrl.'../expositores/'.$expositor->imagem; ?>" title="<?php echo $expositor->nome; ?>" />
								<label><input name="apagar_imagem" type="checkbox" value="true" > Apagar imagem?</label>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'expositor/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
