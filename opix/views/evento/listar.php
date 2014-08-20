<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Eventos</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($listaDeEventos)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="39%" >Nome</th>
						    <th width="15%" >Início do Evento</th>
						    <th width="15%" >Término do Evento</th>
							<th width="21%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($listaDeEventos AS $evento) :
					?>
							<tr>
								<td><?php echo $evento->id; ?></td>
								<td><?php echo $evento->nome; ?></td>
								<td><?php echo $evento->dataInicio; ?></td>
								<td><?php echo $evento->dataFim; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'evento/editar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'evento-'.$evento->id; ?>">
										<i class="btn-icon-only icon-remove"></i>
									</a>
									<a title="Seus Formulários" href="<?php echo Configuracao::$baseUrl.'formulario/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small">
										<i class="btn-icon-only icon-list-alt"></i>
									</a>

									<a title="Sua Agenda" href="<?php echo Configuracao::$baseUrl.'agenda/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-success  btn-small">
										<i class="btn-icon-only icon-calendar"></i>
									</a>

									<a title="Seus Vouchers" href="<?php echo Configuracao::$baseUrl.'voucher/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small">
										<i class="btn-icon-only icon-list-alt"></i>
									</a>
									<a style="display: none;" title="Cadastre Seus Certificados" href="<?php echo Configuracao::$baseUrl.'certificado/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small">
										<i class="btn-icon-only icon-list-alt"></i>
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
					<h3 style="text-align:center;" >Não há eventos cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
