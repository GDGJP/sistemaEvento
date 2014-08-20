<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o publicidade</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-publicidade" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" value="<?php echo $publicidade->nome; ?>" />
						</div>
					</div>
					<div class="control-group" sortable="sortable" id="files-group">
						<label class="control-label" for="imagem">Fotos</label>
						<?php foreach( $fotos as $foto ) : ?>
							<div class="controls" id="item-<?php echo $foto->id; ?>" >
								<input type="hidden" name="ordem[<?php echo $foto->id; ?>]" value="<?php $foto->ordem; ?>" />
								<input type="file" class="input-large" name="imagem[<?php echo $foto->id;  ?>]" />
								<input type="text" class="input-large url" name="link[<?php echo $foto->id; ?>]" value="<?php echo $foto->link; ?>" />
								<?php if( !empty($foto->arquivo) && file_exists(__DIR__.'/../../../publicidade/'.$foto->arquivo) ) : ?>
									<img width="100" src="<?php echo Configuracao::$baseUrl.'../publicidade/'.$foto->arquivo; ?>" title="<?php echo $publicidade->nome.' '.$foto->id; ?>" />
									<input type="hidden" name="imagem_antiga_<?php echo $foto->id ;?>" value="<?php echo $foto->arquivo; ?>"  />
								<?php endif; ?>
								<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'foto-'.$foto->id; ?>">
									<i class="btn-icon-only icon-remove"></i>
								</a>
							</div>
						<?php endforeach; ?>
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
