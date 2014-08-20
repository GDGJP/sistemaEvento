<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Agricultores</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo agricultor" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'agricultor/adicionar'.Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<?php if(!empty($listaDeAgricultores)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="80%" >Nome</th>
							<th width="10%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($listaDeAgricultores AS $agricultor) :
					?>
							<tr>
								<td><?php echo $agricultor->id; ?></td>
								<td><?php echo $agricultor->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'agricultor/editar/'.$agricultor->id.'-'.Funcao::prepararLink($agricultor->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'agricultor-'.$agricultor->id; ?>">
										<i class="btn-icon-only icon-remove"></i>
									</a>
								</td>
							</tr>
					<?php
						endforeach;
					?>
					</tbody>
				</table>
			<?php else : ?>	
				<div class="control-group" >
					<h3 style="text-align:center;" >Não há agricultores cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
