<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Formulários</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<a title="Adicionar novo formulário" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'formulario/adicionar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Adicionar novo
			</a>
			<a title="Adicionar novo tipo de formulário" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'tipoFormulario/listar'.Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Listar Tipos de Formulário
			</a>
			<?php if(!empty($listaDeFormularios)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="70%" >Título</th>
							<th width="20%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($listaDeFormularios AS $formulario) :
					?>
							<tr>
								<td><?php echo $formulario->id; ?></td>
								<td><?php echo $formulario->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'formulario/editar/'.$formulario->id.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Listar Os Templates De Email Do Formulário" href="<?php echo Configuracao::$baseUrl.'templateEmail/listar/'.$formulario->id.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small">
										<i class="btn-icon-only icon-envelope"></i>
									</a>
									<a title="Listar Os Participantes Inscritos" href="<?php echo Configuracao::$baseUrl.'participante/listar/'.$formulario->id.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small">
										<i class="btn-icon-only icon-user"></i>
									</a>
									<a title="Exportar" href="<?php echo Configuracao::$baseUrl.'formulario/exportar/'.$formulario->id.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-upload"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'formulario-'.$formulario->id; ?>">
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
					<h3 style="text-align:center;" >Não há formularios cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
