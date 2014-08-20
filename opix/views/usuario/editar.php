<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Edite seus dados</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-usuario" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $usuario->id; ?>" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" id="nome" value="<?php echo $usuario->nome; ?>" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="text" class="input-large" name="email" id="email" value="<?php echo $usuario->email;?>" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="senha" >Senha</label>
						<div class="controls">
							<input type="password" class="input-large" name="senha" id="senha" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="confirma_senha" >Confirmação de Senha</label>
						<div class="controls">
							<input type="password" class="input-large" name="confirma_senha" id="confirma_senha" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="sexo">Sexo</label>
						<div class="controls">
							<select name="sexo">
								<option <?php echo $usuario->sexo == 'M' ? 'selected="selected"' : ''; ?> value="M" >Masculino</option>
								<option <?php echo $usuario->sexo == 'F' ? 'selected="selected"' : ''; ?> value="F" >Feminino</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tipo">Tipo</label>
						<div class="controls">
							<select name="fkTipoUsuario">
							<?php foreach( $tiposUsuario as $tipoUsuario ) : ?>
								<option <?php echo $usuario->fkTipoUsuario == $tipoUsuario->id ? 'selected="selected"' : ''; ?> value="<?php echo $tipoUsuario->id; ?>" ><?php echo $tipoUsuario->nome; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div> 
					
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
						<a href="<?php echo Configuracao::$baseUrl.'usuario/listar'.Configuracao::$extensaoPadrao; ?>" class="btn">Cancel</a>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 -->   
