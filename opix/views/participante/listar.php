<link href="<?php echo Configuracao::$baseUrl; ?>css/pages/reports.css" rel="stylesheet">
<div class="span12">
  <div class="widget big-stats-container stacked">
	  <div class="widget-content">
		  <div id="big_stats" class="cf">
			  <div class="stat">
				  <h4>Total de pedidos de Inscrição</h4>
				  <span class="value"><?php echo $totalPagos+$totalNaoPagos+$totalIsentos; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Pagos</h4>
				  <span class="value"><?php echo $totalPagos; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Não Pagos</h4>
				  <span class="value"><?php echo $totalNaoPagos; ?></span>
			  </div> <!-- .stat -->
			  <div class="stat">
				  <h4>Isentos</h4>
				  <span class="value"><?php echo $totalIsentos; ?></span>
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
<div class="span12">
	<div class="widget stacked">
		<table id="list2"></table>
		<div id="pager2"></div>
		<div id="modalDetalhes" ></div>
	</div> <!-- /widget -->
</div> <!-- /span12 -->
<script type="text/javascript">
	document.ready = function() {
		var referenciaLargura = $('#list2').parent().width();
	    if($('#list2')) {
			  $("#list2").jqGrid({
				  url: '<?php echo Configuracao::$baseUrl; ?>participante/listarGrid.html',
				  datatype: "json",
				  colNames:['Id','Nome','Função', 'Idade','Email','Estado', 'Cidade','Ações'],
				  colModel:[ {name:'id',index:'id', width: referenciaLargura * (5/100)},
						     {name:'nome',index:'nome', width: referenciaLargura * (20/100)},
						     {name:'funcao',index:'funcao', width: referenciaLargura * (7/100), align: 'center'},
						     {name:'idade',index:'idade', width: referenciaLargura * (3/100), align: 'center'},
						     {name:'email',index:'email', width: referenciaLargura * (17/100)},
						     {name:'estado',index:'estado', width: referenciaLargura * (15/100), align: 'center', stype:'select', searchoptions:{ sopt:['eq'], value: '<?php echo $estadosFormatados; ?>' }},
							 {name:'cidade',index:'cidade', width: referenciaLargura * (15/100), align: 'center', stype:'select', searchoptions:{ sopt:['eq'], value: '<?php echo $cidadesFormatadas; ?>' }, sortable: false},
						     {name:'acoes',index:'acoes', width: referenciaLargura * (35/100), align: 'center'}],
				  rowNum:100,
				  rowList:[100,500,1000],
				  height: '400px',
				  pager: '#pager2',
				  sortname: 'pago',
				  viewrecords: true,
				  sortorder: "asc",
				  caption:"<i class='icon-check'></i> Lista de Participantes",
				  gridComplete: function(){
					  var ids = $("#list2").jqGrid('getDataIDs');
					  for(var i=0; i < ids.length; i++ ){
						  var cl = ids[i];
						  $("#list2").jqGrid('setRowData',ids[i],{acoes:$("#list2").jqGrid('getRowData',ids[i]).acoes+'<a title="detalhes do participante" href="javascript:void(0);" id="visualizar_'+cl+'" class="btn btn-small" ><i class="btn-icon-only icon-eye-open"></i></a>'});
						  $("#list2").jqGrid('setRowData',ids[i],{acoes:$("#list2").jqGrid('getRowData',ids[i]).acoes+'  <a title="Editar" href="<?php echo Configuracao::$baseUrl; ?>participante/editar/'+cl+'-participante<?php echo Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning"><i class="btn-icon-only icon-ok"></i></a>'});
					  }

					$('.btn-pagar').click(function(){
						var id = $(this).attr('id').split('-')[1];
						var botao = $(this);
						$.ajax({
							url : '<?php echo Configuracao::$baseUrl; ?>participante/pagar<?php echo Configuracao::$extensaoPadrao; ?>',
							data : {
								id : id
							},
							type : 'POST',
							dataType : 'html',
							success : function() {
								document.location.reload();
							}
						});
					});

					  $("a[id^=visualizar]").click(function(){
						  var id = $(this).attr('id');
						  id = id.split('_')[1];

						  $.ajax({
							  url : baseUrl + 'participante/detalhesGrid.html',
							  type : 'POST',
							  dataType : 'json',
							  data : {
								  id : id
							  },
							  success : function(resposta) {
								  var lista = $('<ul class="unstyled"></ul>');
								  $.each( resposta, function( indice, valor ) {
									  lista.append('<li><span><label class="label">'+ ucwords(indice.replace('_', ' ')) +':</label>  '+ valor +'</span></li>');
								  });

								  $("#modalDetalhes").html(lista);
								  $("#dialog:ui-dialog").dialog("destroy");
								  $("#modalDetalhes").dialog({
									  title: 'Detalhes do participante ' + resposta.nome,
									  resizable: true,
									  height: 500,
									  width: 700,
									  closeOnEscape: true,
									  modal: false,
									  buttons: {
										  'OK': function () {
											  $(this).dialog("close");
										  }
									  }
								  });
							  }
						  });
					  });

					  $("a[id^=enviar]").click(function(){
						  var id = $(this).attr('id');
						  id = id.split('_')[1];

						  $.ajax({
							  url : baseUrl + 'participante/enviarBoleto.html',
							  type : 'POST',
							  dataType : 'json',
							  data : {
								  id : id
							  },
							  success : function(resposta) {
								  $("#modalDetalhes").html('<p>O envio do boleto ocorreu com sucesso!</p>');
								  $("#dialog:ui-dialog").dialog("destroy");
								  $("#modalDetalhes").dialog({
									  title: 'OK',
									  resizable: true,
									  height: 200,
									  width: 300,
									  closeOnEscape: true,
									  modal: false,
									  buttons: {
										  'OK': function () {
											  $(this).dialog("close");
										  }
									  }
								  });
							  }
						  });
					  });
				  }
			  });
			  $("#list2").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
	    }

		$(".ui-pg-input").css('width', '30px').css('text-align', 'center');
		$(".ui-pg-selbox").css('width', '50px')
						  .css('text-align', 'center')
						  .css('height', '23px')
						  .css('border-radius', '4px 4px 4px 4px');
	}


/* $(function () {

$('.gallery-container > li').hoverIntent({
		over: showPreview,
	     timeout: 500,
	     out: hidePreview,
	     sensitivity: 4
	});

	function showPreview () {
		$(this).find ('.preview').fadeIn ();
	}

	function hidePreview () {
		$(this).find ('.preview').fadeOut ();
	}

	setTimeout (function () {
		$('.gallery-container > li').each (function () {
			var preview, img, width, height;

			preview = $(this).find ('.preview');
			img = $(this).find ('img');

			width = img.width ();
			height = img.height ();

			preview.css ({ width: width });
			preview.css ({ height: height });

			preview.addClass ('ui-lightbox');
		});
	}, 500);

}); */

</script>


