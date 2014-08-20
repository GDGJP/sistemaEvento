<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Salas</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'sala/adicionar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar nova
			</a>
			<a title="Voltar para a Agenda" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'evento/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Voltar para a Agenda
			</a>
			<?php if(!empty($lista)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="70%" >Nome</th>
							<th width="20%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($lista AS $l) :
					?>
							<tr>
								<td><?php echo $l->id; ?></td>
								<td><?php echo $l->nome_pt; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'sala/editar/'.$l->id.'-'.Funcao::prepararLink($l->nome_pt).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'agenda-'.$l->id; ?>">
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
					<h3 style="text-align:center;" >Não há salas cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
