<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione uma nova Tradução</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
            <label class="control-label" for="nome" >Para</label>
						<div class="controls">
							<select name="lang" >
                <option value='pt' >Português</a>
                <option value='en' >Inglês</a>
                <option value='es' >Espanhol</a>
                <option value='nl' >Holandês</a>      
              </select>
						</div>              
						<label class="control-label" for="tipotraducao" >Nome</label>
						<div class="controls">
							<select name="tipotraducao" >
                <option value='' >Selecione...</a>
                <?php foreach($itens as $i) { ?>  
                  <option value="<?php echo $i->id; ?>" ><?php echo $i->nome; ?></a>  
                <?php } ?>
              </select>
						</div>
						<label class="control-label" for="valor" >Valor</label>
						<div class="controls">
							<input type="text" class="input-large" name="valor" />
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'traducao/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
