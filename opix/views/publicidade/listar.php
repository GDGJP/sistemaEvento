<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Publicidades</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($listaDePublicidades)) : ?>
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
						foreach($listaDePublicidades AS $publicidade) :
					?>
							<tr>
								<td><?php echo $publicidade->id; ?></td>
								<td><?php echo $publicidade->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'publicidade/editar/'.$publicidade->id.'-'.Funcao::prepararLink($publicidade->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'publicidade-'.$publicidade->id; ?>">
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
					<h3 style="text-align:center;" >Não há publicidades cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
