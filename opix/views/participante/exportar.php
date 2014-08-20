<?php if(!empty($objetosParticipante)) : ?>
	<table>
		<thead>
			<tr>
			<?php 
				$campos = get_object_vars($objetosParticipante[0]); 
				foreach( $campos as $label => $valor ) :
			?>
					<th><?php echo ucfirst(utf8_decode($label)); ?></th>
			<?php 
				endforeach; 
			?>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach($objetosParticipante AS $objetoParticipante) :
				$campos =  get_object_vars($objetoParticipante);
		?>
				<tr>
					<?php 
						foreach( $campos as $valor ) :
							if( strpos($valor, "||") !== false ) {
								$valores = explode("||", $valor);
								$valor = "";
								foreach( $valores as $indice => $unValor ) {
									$valor .= "&nbsp;&nbsp;&nbsp;&nbsp;".($indice + 1)." - ".utf8_decode($unValor)."<br />";
								}
							}
					?>
							<td align="center"><?php echo utf8_decode($valor); ?></td>
					<?php 
						endforeach;
					?>
				</tr>
		<?php
			endforeach;
		?>
		</tbody>
	</table>
<?php endif; ?>
