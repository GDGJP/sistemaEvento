<script>
	document.ready = function() {
		var oTable = $('.table').dataTable( {
			"sPaginationType": "full_numbers",
			"oLanguage": {
				"sProcessing":   "Processando...",
				"sLengthMenu":   "Mostrar _MENU_ registros",
				"sZeroRecords":  "Não foram encontrados resultados",
				"sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
				"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Primeiro",
					"sPrevious": "Anterior",
					"sNext":     "Seguinte",
					"sLast":     "Último"
				}
			}
		} );
		
		$(".table").css('visibility','visible');
	}
</script>
<style>
	.dataTables_paginate { margin: 0 3% 0 0; }
</style>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Crachás</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($crachas)) : ?>
				<table class="table table-striped table-bordered" style="float:left; visibility:hidden;">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="72%" >Nome</th>
							<th width="18%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php 
						foreach($crachas AS $cracha) :
					?>
							<tr>
								<td><?php echo $cracha->id; ?></td>
								<td><?php echo $cracha->nome; ?></td>
								<td class="td-actions">
									<?php if($cracha->presente == 0) : ?>
										<a title="Confirmar Presença" href="<?php echo Configuracao::$baseUrl.'cracha/confirmarPresenca/'.$cracha->id.'-'.Funcao::prepararLink($cracha->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-danger">
											<i class="btn-icon-only icon-flag"></i>
										</a>
									<?php else : ?>
										<a title="Negar Presença" href="<?php echo Configuracao::$baseUrl.'cracha/negarPresenca/'.$cracha->id.'-'.Funcao::prepararLink($cracha->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-success">
											<i class="btn-icon-only icon-ok"></i>
										</a>
									<?php endif; ?>
									<a title="Imprimir" href="<?php echo Configuracao::$baseUrl.'cracha/imprimir/'.$cracha->id.'-'.Funcao::prepararLink($cracha->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-inverse">
										<i class="btn-icon-only icon-print"></i>
									</a>
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'cracha/editar/'.$cracha->id.'-'.Funcao::prepararLink($cracha->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'cracha-'.$cracha->id; ?>">
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
					<h3 style="text-align:center;" >Não há crachás cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
