<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Tipos de Agricultura</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo tipo de agricultura" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'tipoAgricultura/adicionar'.Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<?php if(!empty($listaDeTiposAgricultura)) : ?>
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
						foreach($listaDeTiposAgricultura AS $tipoAgricultura) :
					?>
							<tr>
								<td><?php echo $tipoAgricultura->id; ?></td>
								<td><?php echo $tipoAgricultura->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'tipoAgricultura/editar/'.$tipoAgricultura->id.'-'.Funcao::prepararLink($tipoAgricultura->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'tipoAgricultura-'.$tipoAgricultura->id; ?>">
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
					<h3 style="text-align:center;" >Não há tipos de agricultura cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
