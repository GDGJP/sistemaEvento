<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione um novo template de email</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-template" class="form-horizontal templateForm" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" id="nome" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="assunto" >Assunto</label>
						<div class="controls">
							<input type="text" class="input-large" name="assunto" id="assunto" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mensagem">Mensagem</label>
						<div class="controls">
							<textarea class="input-large" name="mensagem" id="texto" ></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="adicionar variaveis">Adicionar Variáveis</label>
						<div class="controls">
							<select id="variaveis">
								<option value="">Selecione</option>
							<?php foreach($variaveis as $variavel): 
                if(is_string($variavel)):
              ?>
								<option value="[[<?php echo $variavel; ?>]]" ><?php echo ucwords(str_replace('_', ' ',  $variavel)); ?></option>
							<?php 
                endif;
              endforeach; ?>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'templateEmail/listar/'.$_GET['id'].'-novo-template-email'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
