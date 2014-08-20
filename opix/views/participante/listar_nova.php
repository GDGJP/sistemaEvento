<?php 
if(@$_GET['exportar']!=1) {
?>
<link href="<?php echo Configuracao::$baseUrl; ?>css/pages/reports.css" rel="stylesheet">
<div class="span12">
  <div class="widget big-stats-container stacked">
	  <div class="widget-content">
		  <div id="big_stats" class="cf">
			  <div class="stat">
				  <h4>Total de pedidos de Inscrição | Isentos</h4>
				  <span class="value"><?php echo $totalPagos+$totalNaoPagos+$totalVoucher; ?> | <?php echo $totalIsentos; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Pagos | Não Pagos</h4>
				  <span class="value"><?php echo $totalPagos; ?> | <?php echo $totalNaoPagos; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Isentos | Vouchers</h4>
				  <span class="value"><?php echo $totalIsentos; ?> | </span>
				  <span class="value"><?php echo $totalVoucher; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Compareceu | Não Compareceu</h4>
				  <span class="value"><?php echo $totalCompareceu; ?> | </span>
				  <span class="value"><?php echo $totalNaoCompareceu; ?></span>
			  </div> <!-- .stat -->
	    </div>
    </div> <!-- /widget-content -->
  </div> <!-- /widget -->
</div> <!-- /span12 -->

<div class="span4">
	<div class="widget stacked widget-table">
		<div class="widget-header">
			<span class="icon-list-alt"></span>
			<h3>Inscritos por Estado</h3>
		</div> <!-- .widget-header -->
		<div class="widget-content">
      <table class="table table-bordered table-striped">
        <tbody>
          <?php
	          $count=0;
	          if( !empty($estatisticas->totalEstados) ) :
		          foreach ($estatisticas->totalEstados as $idEstado => $quantidadePorEstado) :
		          $estado = new Estado();
	          	  $estado->selecionarPorId($idEstado);
		            if($count==0) {
		              echo '<tr>';
		            }
		            echo '<td class="description">';
		            echo $estado->nome,': '.$quantidadePorEstado;
		            echo '</td>';
		            if($count==3) {
		              echo '</tr>';
		            }
		            $count++;
		            if($count==3) { $count=0; }
		          endforeach;
	          endif;
          ?>
        </tbody>
      </table>
		</div>
	</div>
</div>

<div class="span3">
	<div class="widget stacked widget-table">
		<div class="widget-header">
			<span class="icon-list-alt"></span>
			<h3>Inscritos por Idade</h3>
		</div> <!-- .widget-header -->
		<div class="widget-content">
      <table class="table table-bordered table-striped">
        <tbody>
          <?php
            echo "<tr><td class='description' >De 16 até 20</td>","<td>",$estatisticas->menorQue_20,"</td></tr>";
            echo "<tr><td class='description' >De 21 até 25</td>","<td>",$estatisticas->entre21_25,"</td></tr>";
            echo "<tr><td class='description' >De 26 até 30</td>","<td>",$estatisticas->entre26_30,"</td></tr>";
            echo "<tr><td class='description' >De 31 até 40</td>","<td>",$estatisticas->entre31_40,"</td></tr>";
            echo "<tr><td class='description' >De 41 até 50</td>","<td>",$estatisticas->entre41_50,"</td></tr>";
            echo "<tr><td class='description' >De 51 até 60</td>","<td>",$estatisticas->entre51_60,"</td></tr>";
            echo "<tr><td class='description' >Maior que 61</td>","<td>",$estatisticas->maiorQue_60,"</td></tr>";
          ?>
        </tbody>
      </table>
		</div>
	</div>
</div>

<div class="span3">
	<div class="widget stacked widget-table">
		<div class="widget-header">
			<span class="icon-list-alt"></span>
			<h3>Inscritos por Setor</h3>
		</div> <!-- .widget-header -->
		<div class="widget-content">
      <table class="table table-bordered table-striped">
        <tbody>
          <?php
            echo "<tr><td class='description' >Acadêmico</td>","<td>",$estatisticas->totalAcademico,"</td></tr>";
            echo "<tr><td class='description' >Governamental</td>","<td>",$estatisticas->totalGovernamental,"</td></tr>";
            echo "<tr><td class='description' >Empresarial</td>","<td>",$estatisticas->totalEmpresarial,"</td></tr>";
            echo "<tr><td class='description' >Terceiro Setor</td>","<td>",$estatisticas->totalTerceiroSetor,"</td></tr>";
          ?>
        </tbody>
      </table>
		</div>
	</div>
</div>
<?php
}
?>
<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>Participantes</h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
			<br />
			<?php if(!empty($listaDeParticipantes)) : ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
              <th width="20%" >Status</th>
							<th width="1%" >ID</th>
							<th width="" >Nome</th>
              <th width="" >Empresa</th>
							<th width="10%" >Fun&ccedil;&atilde;o</th>
							<th width="1%" >Idade</th>
							<th width="1%" >Email</th>
							<th width="10%" >Telefone</th>
							<?php if(@$_GET['exportar']==1) : ?>
								<th width="1%" >CEP</th>
								<th width="10%" >Estado</th>
								<th width="1%" >Cidade</th>
								<th width="1%" >Bairro</th>
								<th width="10%" >Endere&ccedil;o</th>
							<?php endif; ?>
							<th width="10%" class="td-actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$estado = new Estado();
						$cidade = new Cidade();
						foreach($listaDeParticipantes AS $p) :
							$estado->selecionarPorId($p->estado);
							$cidade->selecionarPorId($p->cidade);
              $idadeParticipante = Funcao::calculaIdade($p->data_nascimento);
              if( $p->funcao == 'participante' ) {
	              if($p->pago) {
		              $botao = '<a id="participante-'.$p->id.'" title="Desaprovar o pagamento do participante" href="javascript:void(0);" class="btn btn-small btn-success btn-pagar" style="width:35%; margin-right:2%; color:white;">Pago</a>';
	              } else {
		              $botao = '<a title="enviar boleto ao participante por email" href="javascript:void(0);" id="enviar_'.$p->id.'" class="btn btn-small" ><i class="btn-icon-only icon-envelope"> enviar boleto</i></a> <a id="participante-'.$p->id.'" title="Aprovar o pagamento do participante" href="javascript:void(0);" class="btn btn-small btn-danger btn-pagar" style="width:35%; margin-right:2%; color:white;">N&atilde;o Pago</a>';
	              }

                //Com voucher
                if($p->voucher) {
                  $botao = '<a title="Voucher: '.$p->voucher.'" href="javascript:void(0);" class="btn btn-small btn-info btn-pagar" style="width:35%; margin-right:2%; color:white;" >Voucher</a>';
                }
              } else {
	              $botao = '<a id="isento-'.$p->id.'" title="Participante isento de pagamento" href="javascript:void(0);" class="btn btn-small btn-primary" style="width:35%; margin-right:2%; color:white;">Isento</a>';
              }
					?>
							<tr>
                <td><?php echo $botao; ?></td>
								<td><?php echo $p->id; ?></td>
                <?php if(@$_GET['exportar']==1) { ?>
								  <td><?php echo utf8_decode($p->nome); ?></td>
								  <td><?php echo utf8_decode($p->instituicao); ?></td>
                <?php } else { ?>
                  <td><?php echo $p->nome; ?></td>
								  <td><?php echo $p->instituicao; ?></td>
                <?php } ?>
								<td><?php echo $p->funcao; ?></td>
								<td><?php echo $idadeParticipante ?></td>
								<td><?php echo $p->email; ?></td>
								<td><?php echo $p->telefone; ?></td>
								<?php if(@$_GET['exportar']==1) : ?>
									<td><?php echo utf8_decode($p->cep); ?></td>
									<td><?php echo utf8_decode($estado->nome); ?></td>
									<td><?php echo utf8_decode($cidade->nome); ?></td>
									<td><?php echo utf8_decode($p->bairro); ?></td>
									<td><?php echo utf8_decode($p->logradouro.' - '.$p->numero.(!empty($p->complemento) ? ' - '.$p->complemento : '')); ?></td>
								<?php endif; ?>
								<td class="td-actions">
									<a title="Editar" href="<?php echo Configuracao::$baseUrl.'participante/editar/'.$p->id.'-'.Funcao::prepararLink($p->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										<i class="btn-icon-only icon-edit"></i>
									</a>
									<?php $texto = ($p->confirmou == 1) ? "Compareceu" : "Não Compareceu"; ?>
										<a title="<?php echo $texto; ?>" href="<?php echo Configuracao::$baseUrl.'participante/confirmar/'.$p->id.'-'.Funcao::prepararLink($p->nome).Configuracao::$extensaoPadrao; ?>" class="btn btn-small <?php echo ($p->confirmou == 1) ? 'btn-success' : 'btn-danger'; ?>">
											<?php echo $texto; ?>
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
					<h3 style="text-align:center;" >Não há itens cadastrados</h3>
				</div>
			<?php endif; ?>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->


