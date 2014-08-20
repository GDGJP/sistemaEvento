<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Marque os crachás que serão impressos</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<form method="post" action="<?php echo Configuracao::$baseUrl . 'cracha/imprimirSelecionados' . Configuracao::$extensaoPadrao; ?>" id="validation-form" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>
					<div class="control-group">
						<select name="posicao">
							<?php for($i = 1; $i <= 10; $i++) : ?>
								<option value="<?php echo $i; ?>"><?php echo "Posição : ".$i; ?></option>
							<?php endfor; ?>
						</select>
					</div>
					<div class="control-group">
						<?php
							foreach( $crachas as $cracha ) {
						?>
								<input type="checkbox" name="idsCrachas[]" value="<?php echo $cracha->id; ?>" /><?php echo $cracha->nome; ?><br />
						<?php
							}
						?>
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
