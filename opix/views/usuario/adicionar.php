<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Adicione um novo usuário</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<form method="post" action="" id="validation-form-new-usuario" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $usuario->id; ?>" />
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="nome" >Nome</label>
						<div class="controls">
							<input type="text" class="input-large" name="nome" id="nome" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="text" class="input-large" name="email" id="email" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="sexo">Sexo</label>
						<div class="controls">
							<select name="sexo">
								<option value="M" >Masculino</option>
								<option value="F" >Feminino</option>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="senha" >Senha</label>
						<div class="controls">
							<input type="password" class="input-large" name="senha" >
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="tipo">Tipo</label>
						<div class="controls">
							<select name="fkTipoUsuario">
							<?php foreach( $tiposUsuarios as $tipoUsuario ) : ?>
								<option value="<?php echo $tipoUsuario->id; ?>" ><?php echo $tipoUsuario->nome; ?></option>
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
