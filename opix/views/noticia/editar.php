<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite a notícia</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="categoria">Categoria</label>
						<div class="controls">
							<select name="categoria">
							<?php foreach($categorias as $categoria) : ?>
								<option <?php echo ( $noticia->fkCategoria == $categoria->id ) ? 'selected="selected"' : ''; ?> value="<?php echo $categoria->id; ?>" ><?php echo $categoria->nome; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="titulo" >Título</label>
						<div class="controls">
							<input type="text" class="input-large" name="titulo" required="required" value="<?php echo $noticia->titulo; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="resumo">Resumo</label>
						<div class="controls">
							<textarea name="resumo" id="resumo" required="required" ><?php echo $noticia->resumo; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="texto">Texto</label>
						<div class="controls">
							<textarea class="texto" name="texto" id="texto" ><?php echo $noticia->texto; ?></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="imagem">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem" />
							<?php if( !empty($noticia->imagem) && file_exists(__DIR__.'/../../../noticias/'.$noticia->imagem) ) : ?>
							    <br /><br />
								<img src="<?php echo Configuracao::$baseUrl.'../noticias/'.$noticia->imagem; ?>" title="<?php echo $noticia->titulo; ?>" />
								<label><input name="apagar_imagem" type="checkbox" value="true" > Apagar imagem?</label>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'noticia/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
