<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Notícias</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($noticias)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th width="10%" >ID</th>
							<th width="75%" >Título</th>
							<th width="15%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($noticias AS $noticia) :
					?>
							<tr>
								<td><?php echo $noticia->id; ?></td>
								<td><?php echo $noticia->titulo; ?></td>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'noticia/editar/'.$noticia->id.'-'.Funcao::prepararLink($noticia->titulo).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-ok"></i>
									</a>
									<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'noticia-'.$noticia->id; ?>">
										<i class="btn-icon-only icon-remove"></i>
									</a>
									 <a title="<?php echo $noticia->destacado ? 'Desmarcar' : 'Marcar'; ?>" href="javascript:;" class="btn btn-small" id="<?php echo 'noticia-'.$noticia->id; ?>">
										  <i class="btn-icon-only icon-<?php echo $noticia->destacado ? 'star' : 'star-empty'; ?>"></i>
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
					<h3 style="text-align:center;" >Não há notícias cadastradas</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
