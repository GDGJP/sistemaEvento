<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Templates de email do formulário <?php echo $formulario->nome; ?></h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo template de email" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'templateEmail/adicionar/'.$formulario->id.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<?php if(!empty($templatesEmails)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="37%" >Nome</th>
						    <th width="40%" >Assunto</th>
							<th width="13%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($templatesEmails AS $templateEmail) :
					?>
							<tr>
								<td><?php echo $templateEmail->id; ?></td>
								<td><?php echo $templateEmail->nome; ?></td>
								<td><?php echo $templateEmail->assunto; ?></td>
								<td class="td-actions">
									<a href="<?php echo Configuracao::$baseUrl.'templateEmail/editar/'.$templateEmail->id.'-'.Funcao::prepararLink($templateEmail->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning" title="editar" >
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a href="javascript:;" class="btn btn-small" title="excluir" id="<?php echo 'templateEmail-'.$templateEmail->id; ?>">
										<i class="btn-icon-only icon-remove"></i>
									</a>
									<a href="<?php echo Configuracao::$baseUrl.'templateEmail/enviar/'.$templateEmail->id.'-'.Funcao::prepararLink($templateEmail->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small" title="enviar email" >
										<i class="btn-icon-only icon-circle-arrow-up"></i>
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
					<h3 style="text-align:center;" >Não há templates de email cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
