<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite a categoria</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-categoria" class="form-horizontal categoriaForm" enctype="multipart/form-data">
				<fieldset>
					<fieldset>
					<div class="control-group">
            <label class="control-label" for="nome" >Para</label>
						<div class="controls">
							<select name="lang" >
                
                <option value='pt' <?php if($traducao->lang=='pt') { echo 'selected="selected"'; } ?> >Português</a>
                <option value='en' <?php if($traducao->lang=='en') { echo 'selected="selected"'; } ?> >Inglês</a>
                <option value='es' <?php if($traducao->lang=='es') { echo 'selected="selected"'; } ?> >Espanhol</a>
                <option value='nl' <?php if($traducao->lang=='nl') { echo 'selected="selected"'; } ?> >Holandês</a>      
              </select>
						</div>              
						<label class="control-label" for="tipotraducao" >Nome</label>
						<div class="controls">
							<select name="tipotraducao" >
                <option value='' >Selecione...</a>
                <?php foreach($itens as $i) { ?>  
                  <option value="<?php echo $i->id; ?>" <?php if($i->id==$traducao->fkItemTraducao) { echo 'selected="selected"'; } ?> ><?php echo $i->nome; ?></a>  
                <?php } ?>
              </select>
						</div>
						<label class="control-label" for="valor" >Valor</label>
						<div class="controls">
							<input type="text" class="input-large" name="valor" value="<?php echo $traducao->valor; ?>" />
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'traducao/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 -->
