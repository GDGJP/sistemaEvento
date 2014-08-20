<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Crie seu formulário</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-formulario" class="form-horizontal">
				<input type="hidden" name="fk_evento" value="<?php echo $_GET['id']; ?>" >
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" id="nome" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tipo">Tipo</label>
						<div class="controls">
							<select name="fkTipoFormulario">
							<?php foreach($tiposFormulario as $tipoFormulario) : ?>
								<option value="<?php echo $tipoFormulario->id; ?>" ><?php echo $tipoFormulario->nome; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<?php /* if( $tipoFormulario->certificado == 1 ) : ?>
						<div class="control-group">
							<label class="control-label" for="certificado">Certificado</label>
							<div class="controls">
								<select name="fkCertificado">
								<?php foreach($certificados as $certificado) : ?>
									<option value="<?php echo $certificado->id; ?>" ><?php echo $certificado->nome; ?></option>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
					<?php endif; */?>
					<div class="control-group">
						<label class="control-label" for="tipo">Escolha o número de passos/fases desse formulário</label>
						<div class="controls">
							<select name="numeroDePassos">
							<?php for($i = 1; $i <= 5; $i++) : ?>
								<option value="<?php echo $i; ?>" ><?php echo $i.' Passo(s)'; ?></option>
							<?php endfor; ?>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'formulario/listar/'.$_GET['id'].'-novo-formulario'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
