<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o palestrante</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" required="required" name="nome" value="<?php echo $palestrante->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="descricao">Descrição</label>
						<div class="controls">
							<textarea name="descricao" id="descricao" required="required" ><?php echo $palestrante->descricao; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="foto">Foto</label>
						<div class="controls">
							<input type="file" class="input-large" name="foto" />
							<?php if( !empty($palestrante->foto) && file_exists(__DIR__.'/../../../palestrantes/'.$palestrante->foto) ) : ?>
							    <br /><br />
								<img src="<?php echo Configuracao::$baseUrl.'../palestrantes/'.$palestrante->foto; ?>" title="<?php echo $palestrante->nome; ?>" />
								<label><input name="apagar_foto" type="checkbox" value="true" > Apagar imagem?</label>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'palestrante/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
