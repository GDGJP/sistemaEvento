<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Redes Sociais</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($listaDeRedesSociais)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="85%" >Título</th>
							<th width="5%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($listaDeRedesSociais AS $redeSocial) :
					?>
							<tr>
								<td><?php echo $redeSocial->id; ?></td>
								<td><?php echo $redeSocial->titulo; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'redeSocial/editar/'.$redeSocial->id.'-'.Funcao::prepararLink($redeSocial->titulo).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<?php /*<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'redeSocial-'.$redeSocial->id; ?>">
										<i class="btn-icon-only icon-remove"></i>*/ ?>
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
					<h3 style="text-align:center;" >Não há redes sociais cadastradas</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
