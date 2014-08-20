<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite o painel</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
          <div class="control-group">
            <label class="control-label" for="lang" >Língua</label>
					  <div class="controls">
						  <select name="lang" >
                <option value='pt' <?php if($painel->lang=='pt') { echo 'selected="selected"'; } ?> >Português</a>
                <option value='en' <?php if($painel->lang=='en') { echo 'selected="selected"'; } ?> >Inglês</a>
                <option value='es' <?php if($painel->lang=='es') { echo 'selected="selected"'; } ?> >Espanhol</a>
                <option value='nl' <?php if($painel->lang=='nl') { echo 'selected="selected"'; } ?> >Holandês</a>      
              </select>
  					</div>      
					</div>      
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" value="<?php echo $painel->nome; ?>" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="imagem">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem" />
							<?php if( !empty($painel->imagem) && file_exists(__DIR__.'/../../../painel/'.$painel->imagem) ) : ?>
								<img src="<?php echo Configuracao::$baseUrl.'../painel/'.$painel->imagem; ?>" title="<?php echo $painel->nome; ?>" />
							<?php endif; ?>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'painel/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
