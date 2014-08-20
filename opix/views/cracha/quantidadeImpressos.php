<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Digite a quantidade de crachás a ser impresso e a partir de qual</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<form method="post" action="<?php echo Configuracao::$baseUrl . 'cracha/imprimirTodos' . Configuracao::$extensaoPadrao; ?>" id="validation-form" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<input type="text" name="quantidade" placeholder="Total Para Impressão (Padrão: 500)" class="input-xlarge" />
						<input type="text" name="inicio" placeholder="Iniciar de (Padrão: 0)" class="input-xlarge" />
						<small>Função dos Impressos: </small>
						<select name="funcao">
							<option value="todas" >Todas</option>
							<option value="participante" >Participante</option>
							<option value="staff" >Staff</option>
							<option value="imprensa" >Imprensa</option>
							<option value="painelista">Painelista</option>
							<option value="expositor" >Expositor</option>
							<option value="organizacao" >Organização</option>
						</select>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger btn">Enviar</button>&nbsp;&nbsp;
						<button type="button" class="btn buttonControlCheck">Marcar Todos</button>
					</div>
				</fieldset>
			</form>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 --> 
