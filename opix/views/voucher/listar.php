<script type="text/javascript">
	document.ready = function(){
		$("#toggleMark").change(function(){
			if( typeof $(this).attr("checked") != 'undefined' ) {
				$('.mark').attr('checked', 'checked');
			} else {
				$('.mark').attr('checked', false);
			}
		});
	}
</script>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Vouchers</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<a title="Gerar novos vouchers" style="float:right; margin-bottom: 20px;" href="<?php echo Configuracao::$baseUrl.'voucher/adicionar'.Configuracao::$extensaoPadrao; ?>" class="btn btn-large">
				Gerar novos vouchers
			</a>
			<?php if(!empty($listaDeVouchers)) : ?>
				<form style="float:left; width:100%;" action="<?php echo Configuracao::$baseUrl.'voucher/baixar'.Configuracao::$extensaoPadrao; ?>" method="POST" >
					<input style="float:right; margin-bottom: 20px; width: 19.5%!important;" class="btn btn-large" type="submit" value="Baixar Selecionados" />
					<input type="hidden" value="<?php echo $_GET['id']; ?>" name="fkEvento" />
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="1%" ><input id="toggleMark" type="checkbox" /></th>
								<th width="10%" >ID</th>
								<th width="39%" >Voucher</th>
							    <th width="15%" >Usado</th>
							    <th width="15%" >Enviado</th>
								<!--th width="21%" class="td-actions"></th-->
							</tr>
						</thead>
						<tbody>
						<?php 
							foreach($listaDeVouchers AS $voucher) :
						?>
								<tr>
									<td><input class="mark" type="checkbox" name="vouchers[]" value="<?php echo $voucher->arquivo; ?>" /></td>
									<td><?php echo $voucher->id; ?></td>
									<td><?php echo $voucher->hash; ?></td>
									<td><?php echo ( $voucher->usado == 1 ) ? 'Sim' : 'Não'; ?></td>
									<td><?php echo ( $voucher->enviado == 1 ) ? 'Sim' : 'Não'; ?></td>
									<!--td class="td-actions">
										<a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'voucher-'.$voucher->id; ?>">
											<i class="btn-icon-only icon-remove"></i>
										</a>
									</td-->
								</tr>
						<?php
							endforeach;
						?>
						</tbody>
					</table>
				</form>
			<?php else : ?>	
				<div class="control-group" >
					<h3 style="text-align:center;" >Não há vouchers cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
