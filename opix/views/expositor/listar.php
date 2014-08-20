<script type="text/javascript">
	document.ready = function() {
		var tabela = $("#tabelaExpositores tbody").sortable({
			cursor: 'move',
			start: function() {
				$("#tabelaExpositores tbody a").tooltip('destroy');
			},
			update: function(evento, elemento) {
				var posicoes = {};

				tabela.find('tr').each(function(id, elemento){
					posicoes[id + 1] = $(elemento).attr('id').split('-')[1];
					$($(elemento).find('td')[0]).text(id + 1);
				});

				$.ajax({
					url : '<?php echo Configuracao::$baseUrl.'expositor/atualizaPosicoes'.Configuracao::$extensaoPadrao; ?>',
					type: 'POST',
					data : {
						posicoes : posicoes
					},
					async: false
				});

				$("#tabelaExpositores tbody a").tooltip();
			}
		});
	};
</script>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Expositores</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<form method="post" action="<?php echo Configuracao::$baseUrl.'expositor/atualizarMapa'.Configuracao::$extensaoPadrao; ?>" id="validation-form-categoria" class="form-horizontal" enctype="multipart/form-data">
				<div class="control-group">
					<div style="margin-left: 150px;" class="controls">
						<img src="<?php echo Configuracao::$baseUrl.'../img/mapa.jpg'; ?>" />
						<br /><br />
						<input style="margin-left: 180px;" type="file" class="input-large" name="mapa" />
						<button type="submit" class="btn btn-danger btn">Salvar</button>&nbsp;&nbsp;
					</div>
				</div>
			</form>
			<br />
			<?php if(!empty($expositores)) : ?>
				<table id="tabelaExpositores" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="5%" >Posição</th>
							<th width="5%" >ID</th>
							<th width="80%" >Nome</th>
							<th width="10%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($expositores AS $expositor) :
					?>
							<tr id="exp-<?php echo $expositor->id; ?>" >
								<td><?php echo $expositor->posicao; ?></td>
								<td><?php echo $expositor->id; ?></td>
								<td><?php echo $expositor->nome; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'expositor/editar/'.$expositor->id.'-'.Funcao::prepararLink($expositor->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'expositor-'.$expositor->id; ?>">
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
					<h3 style="text-align:center;" >Não há expositores cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
