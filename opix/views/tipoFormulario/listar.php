<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Tipos de Formulários</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo tipo de formulário" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'tipoFormulario/adicionar'.Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<?php if(!empty($listaDeTiposFormularios)) : ?>
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
						foreach($listaDeTiposFormularios AS $tipoFormulario) :
					?>
							<tr>
								<td><?php echo $tipoFormulario->id; ?></td>
								<td><?php echo $tipoFormulario->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'tipoFormulario/editar/'.$tipoFormulario->id.'-'.Funcao::prepararLink($tipoFormulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'tipoFormulario-'.$tipoFormulario->id; ?>">
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
					<h3 style="text-align:center;" >Não há tipos de formulários cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
