<?php if(!empty($listaDeSugestoes)) : ?>
	<table>
		<thead>
			<tr>
				<th width="1%">ID</th>
				<th width="10%">Nome</th>
				<th width="10%">Email</th>
				<th width="10%">Setor</th>
				<th width="2%">Endereco</th>
				<th width="10%">UF</th>
				<th width="27%"><?php echo utf8_decode('Título do Tema'); ?></th>
				<th width="30%">Justificativa</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach($listaDeSugestoes AS $sugestao) :
		?>
				<tr>
					<td align="center"><?php echo $sugestao->id; ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->nome); ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->email); ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->setor); ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->endereco); ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->uf); ?></td>
					<td align="center"><?php echo utf8_decode($sugestao->titulo_tema); ?></td>
					<td align="center" ><?php echo utf8_decode($sugestao->justificativa); ?></td>
				</tr>
		<?php
			endforeach;
		?>
		</tbody>
	</table>
<?php endif; ?>
