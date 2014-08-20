<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Palestrantes</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($palestrantes)) : ?>
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
						foreach($palestrantes AS $palestrante) :
					?>
							<tr>
								<td><?php echo $palestrante->id; ?></td>
								<td><?php echo $palestrante->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'palestrante/editar/'.$palestrante->id.'-'.Funcao::prepararLink($palestrante->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'palestrante-'.$palestrante->id; ?>">
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
					<h3 style="text-align:center;" >Não há palestrantes cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
