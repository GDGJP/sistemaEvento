<html>
<head>
	<meta charset="UTF-8">
	<style>
		@media print, screen {
			* { margin:0; }
			@page {margin-top: 97px;}
			.direita {margin-left: 41%;}
			.esquerda {margin-left: 25%;}
			.folha{ margin-left: 49px; page-break-after:always; }
			.layoutAdesivo { width: 295px; height: 165px; }
			.layoutAdesivo > img { float: left; height: 145px; margin: 0 10px 0 0; width: 110px; }
			.layoutAdesivo span { font-family: Helvetica, Arial, Ubuntu; }
			.layoutAdesivo span h4 { text-transform: capitalize; height:40px; margin: 10px 0 0 0; }
			.layoutAdesivo span img#barcode {height: 39px; margin: -56px 0 33px 116px; width: 156px;}
			.layoutAdesivo div { background-color: #000000; color: #FFFFFF; float: left; font-size: 24px; font-weight: bolder; height: 28px; margin: -21px 22.6px 0 0; width: 295px; text-align: center; line-height: 30px; }
			.layoutAdesivo div small { text-transform: uppercase; }
		}
	</style>
</head>
	<?php foreach($divisaoCrachas as $indicePagina => $crachas) : ?>
			<table class="folha" cellspacing="0" cellpadding="0">
				<?php foreach( $crachas as $indiceLinha => $linhaCracha ) : ?>
					<tr>
						<?php foreach( $linhaCracha as $indice => $cracha ) : ?>
							<?php if( $indicePagina == 1 && ( ( $posicaoInicio / 2 ) > $indiceLinha || ( ($posicaoInicio / 2) == $indiceLinha && ($posicaoInicio % 2) == ($indice % 2) ) ) ) : ?>
								<td class="layoutAdesivo" style="background: url('images/trans.png');">&nbsp;</td>
							<?php else : ?>
								<?php 
									$participante = $cracha->getParticipante(); 
									$objetoParticipante = json_decode($participante->respostas);
									$pais = !empty($objetoParticipante->paises) ? $objetoParticipante->paises : 'BR';
								?>
								<td class="layoutAdesivo" >
									<img src="<?php echo Configuracao::$baseUrl . '../fotosParticipantes/' . $cracha->foto; ?>" />
									<span>
										<h4><?php echo mb_strtolower($cracha->nome, 'UTF-8'); ?></h4>
										<img src="<?php echo Configuracao::$baseUrl . '../images/bandeiras/paises/' . $pais . '.png'; ?>" />
										<img id="barcode" src="data:image/png;base64,<?php echo base64_encode($codigosDeBarras[$cracha->id]); ?>" />
									</span>
									<div>
										<small><?php echo $cracha->funcao; ?></small>
									</div>
								</td>
							<?php endif; ?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</table>
	<?php 
		endforeach; 
	?>
