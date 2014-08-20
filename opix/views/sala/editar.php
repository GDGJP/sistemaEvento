<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>editar</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-evento" class="form-horizontal eventoForm" enctype="multipart/form-data">
				<fieldset>
					<input type="hidden" name="fkEvento" value="<?php echo $sala->fkEvento; ?>" />
					<input type="hidden" name="id" value="<?php echo $sala->id; ?>" />

					<div class="control-group">
						<label class="control-label" for="nome_pt" >Nome (Português)</label>
						<div class="controls">
							<input name="nome_pt" type="text" id="nome_pt" value="<?php echo $sala->nome_pt; ?>" />
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="nome_en">Nome (Inglês)</label>
						<div class="controls">
							<input name="nome_en" type="text" id="nome_en" value="<?php echo $sala->nome_en; ?>" />
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'sala/listar/'.$_GET['evento'].'-evento'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
