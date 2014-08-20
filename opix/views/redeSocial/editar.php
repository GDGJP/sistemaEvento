<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite a rede social</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-rede-social" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="titulo" >Título</label>
						<div class="controls">
							<input type="text" class="input-large" name="titulo" value="<?php echo $redeSocial->titulo; ?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="link">Link</label>
						<div class="controls">
							<input type="text" class="input-large url" name="link" value="<?php echo $redeSocial->link; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="imagem">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem" />
							<?php if( !empty($redeSocial->imagem) && file_exists(__DIR__.'/../../../redes_sociais/'.$redeSocial->imagem) ) : ?>
								<img src="<?php echo Configuracao::$baseUrl.'../redes_sociais/'.$redeSocial->imagem; ?>" title="<?php echo $redeSocial->titulo; ?>" />
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'redeSocial/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
