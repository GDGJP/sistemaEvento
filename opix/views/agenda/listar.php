<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Agenda</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'agenda/adicionar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<a title="" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'sala/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Listar Salas
			</a>
			<?php if(!empty($lista)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="1%" >Dia</th>
							<th width="1%" >Sala</th>
							<th width="1%" >Início</th>
							<th width="1%" >Fim</th>
							<th width="70%" >Texto</th>
							<th width="20%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($lista AS $l) :
							$sala = new Sala();
							$sala->selecionarPorId($l->fkSala);
					?>
							<tr>
								<td><?php echo $l->id; ?></td>
								<td><?php echo Funcao::dateFormat($l->dia); ?></td>
								<td><?php echo $sala->nome_pt; ?></td>
								<td><?php echo $l->hora_inicial; ?></td>
								<td><?php echo $l->hora_final; ?></td>
								<td style="background-color: #<?php echo $l->cor; ?>"  ><?php echo $l->texto_pt; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'agenda/editar/'.$l->id.'-'.Funcao::prepararLink($l->texto_pt).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
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
					<h3 style="text-align:center;" >Não há agendas cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
