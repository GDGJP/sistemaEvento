<div class="span12">
	<div class="widget stacked">
	<?php if( !empty($listaDeParticipantes) ) : ?>
		<form>
			<?php foreach( $listaDeParticipantes as $cpf => $participantes ) : ?>
				<h3>CPF: <?php echo $cpf; ?></h3>
				<?php foreach( $participantes as $participante ) : ?>
					<?php $objetoParticipante = !empty($participante->respostas) ? json_decode($participante->respostas) : json_decode('{"nome":""}'); ?>
					<input type="checkbox" name="ids[]" value="<?php echo $participante->id; ?>" /> <?php echo $objetoParticipante->nome.' <'.$objetoParticipante->cpf.'> '; ?><br />
				<?php endforeach; ?>
			<?php endforeach; ?>
			<input type="submit" value="enviar" class="btn btn-medium" />
		</form>
	<?php else : ?>
		<p>Não há participantes com CPF Duplicado</p>
	<?php endif; ?>
	</div> <!-- /widget -->
</div> <!-- /span12 -->
