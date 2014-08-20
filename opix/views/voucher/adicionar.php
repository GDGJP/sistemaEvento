<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Gerar Voucher</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<input type="hidden" name="fkEvento" value="<?php echo $_GET['id']; ?>" />
					<div class="control-group">
						<label class="control-label" for="quantidade">Quantidade</label>
						<div class="controls">
							<input type="text" class="input-small text-right" name="quantidade" id="quantidade" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="quantidadePorZip" >Quantidade Por Zip</label>
						<div class="controls">
							<input type="text" class="input-small text-right" name="quantidade_por_zip" id="quantidadePorZip" />
						</div>
					</div>
					<div class="control-group input-append">
						<label class="control-label" for="desconto" >Desconto</label>
						<div class="controls">
							<input type="text" class="input-mini text-right" name="desconto" id="desconto" max="100" />
							<span class="add-on">%</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="mensagem">Mensagem</label>
						<div class="controls">
							<textarea class="input-large texto" name="template" id="texto" ></textarea>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="adicionar variaveis">Adicionar Variáveis</label>
						<div class="controls">
							<select id="variaveis">
								<option value="">Selecione</option>
								<option value="[[voucher]]" >Voucher</option>
								<option value="[[desconto]]" >Desconto</option>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Gerar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'voucher/listar/'.$_GET['evento'].'-evento'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
