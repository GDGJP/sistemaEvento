<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Detalhes do Participante <?php echo $objetoParticipante->nome; ?></h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<fieldset>
				<div class="control-group">
					<?php 
						$detalhes = get_object_vars($objetoParticipante);
						foreach ($detalhes as $label => $valor) {
							if( strpos($valor, "||") !== false ) {
								$valores = explode("||", $valor);
								$valor = "";
								foreach( $valores as $indice => $unValor ) {
									$valor .= "&nbsp;&nbsp;&nbsp;&nbsp;".($indice + 1)." - ".$unValor."<br />";
								}
							}
					?>
							<span><label><?php echo ucfirst(str_replace(array("idIngresso", "quantidade_ingressos"), array("Código do Ingresso", "Quantidade de ingresso comprados"), $label)); ?>: </label><?php echo $valor; ?></span><br /><br />
					<?php 
						}
					?>
				</div>
			</fieldset>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->					
</div> <!-- /span12 -->