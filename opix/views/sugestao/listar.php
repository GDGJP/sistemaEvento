<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Sugestões</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($listaDeSugestoes)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="60%">Nome</th>
							<th width="25%">Título do Tema</th>
							<? /*<th width="5%" >Status</th>*/?>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($listaDeSugestoes AS $sugestao) :
					?>
							<tr>
								<td><?php echo $sugestao->id; ?></td>
								<td><?php echo $sugestao->nome; ?></td>
								<td><?php echo $sugestao->titulo_tema; ?></td>
								<? /* <td class="td-actions">
								<?php if( !$sugestao->status ) { ?>
									<a title="Marcar" href="<?php echo Configuracao::$baseUrl.'sugestao/status/'.$sugestao->id.'-'.Funcao::prepararLink($sugestao->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-mini btn-success">
										<i class="btn-icon-only icon-plus-sign"></i>
									</a>
								<?php } else { ?>
									<a title="Desmarcar" href="<?php echo Configuracao::$baseUrl.'sugestao/status/'.$sugestao->id.'-'.Funcao::prepararLink($sugestao->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-mini btn-danger" >
										<i class="btn-icon-only icon-minus-sign"></i>
									</a>
								<?php } ?>
								</td> */ ?>
							</tr>
					<?php
						endforeach;
					?>
					</tbody>
				</table>
			<?php else : ?>	
				<div class="control-group" >
					<h3 style="text-align:center;" >Não há sugestões cadastradas</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
