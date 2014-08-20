<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione um novo painel</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
          <div class="control-group">
            <label class="control-label" for="lang" >Língua</label>
					  <div class="controls">
						  <select name="lang" >
                <option value='pt' >Português</a>
                <option value='en' >Inglês</a>
                <option value='es' >Espanhol</a>
                <option value='nl' >Holandês</a>      
              </select>
  					</div>      
					</div>      
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="imagem">Imagem</label>
						<div class="controls">
							<input type="file" class="input-large" name="imagem" />
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
