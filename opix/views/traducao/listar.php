<div class="span12">
	<div class="widget stacked">
		<div class="widget-header">
			<i class="icon-check"></i>
			<h3>
        Traduções <a href="<?php echo Configuracao::$baseUrl; ?>traducao/adicionar.html" >[Adicionar]</a>
  			
      </h3>
		</div> <!-- /widget-header -->
		<div class="widget-content">
        <form method="post" action="<?php echo Configuracao::$baseUrl; ?>traducao/criararquivo.html" >
          <select name="l" >
            <option value='pt' >Português</a>
            <option value='en' >Inglês</a>
            <option value='es' >Espanhol</a>
            <option value='nl' >Holandês</a>      
          </select>
          <input type="submit" value="Gerar Arquivo" />
        </form>
			<br />
      <div id="tabs" style="display: none;" >
        <ul>
          <li><a href="#tabs-1">Português</a></li>
          <li><a href="#tabs-2">Inglês</a></li>
          <li><a href="#tabs-3">Espanhol</a></li>
          <li><a href="#tabs-4">Holandês</a></li>
        </ul>
        <div id="tabs-1">
    			<?php if(!empty($listaPT)) : ?>
				  <table class="table table-striped table-bordered">
					  <thead>
						  <tr>
							  <th width="1%" >ID</th>
							  <th width="1%" >Lingua</th>
							  <th width="1%" >Tipo</th>
							  <th width="80%" >Nome</th>
							  <th width="20%" class="td-actions"></th>
						  </tr>
					  </thead>
					  <tbody>
					  <?php 
						  foreach($listaPT AS $i) :
                $item = new ItemTraducao();
                $item->selecionarPorId($i->fkItemTraducao);
					  ?>
							  <tr>
								  <td><?php echo $i->id; ?></td>
								  <td><?php echo $i->lang; ?></td>
								  <td><?php echo $item->nome; ?></td>
								  <td><?php echo $i->valor; ?></td>
								  <td class="td-actions">
									  <a title="Editar" href="<?php echo Configuracao::$baseUrl.'traducao/editar/'.$i->id.'-'.Funcao::prepararLink($i->valor).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										  <i class="btn-icon-only icon-edit"></i>
									  </a>
									  <a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'traducao-'.$i->id; ?>">
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
					  <h3 style="text-align:center;" >Não há itens cadastradas</h3>
				  </div>
			  <?php endif; ?>
      </div>
      <div id="tabs-2">
  			<?php if(!empty($listaEN)) : ?>
				  <table class="table table-striped table-bordered">
					  <thead>
						  <tr>
							  <th width="1%" >ID</th>
							  <th width="1%" >Lingua</th>
							  <th width="1%" >Tipo</th>
							  <th width="80%" >Nome</th>
							  <th width="20%" class="td-actions"></th>
						  </tr>
					  </thead>
					  <tbody>
					  <?php 
						  foreach($listaEN AS $i) :
                $item = new ItemTraducao();
                $item->selecionarPorId($i->fkItemTraducao);
					  ?>
							  <tr>
								  <td><?php echo $i->id; ?></td>
								  <td><?php echo $i->lang; ?></td>
								  <td><?php echo $item->nome; ?></td>
								  <td><?php echo $i->valor; ?></td>
								  <td class="td-actions">
									  <a title="Editar" href="<?php echo Configuracao::$baseUrl.'traducao/editar/'.$i->id.'-'.Funcao::prepararLink($i->valor).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										  <i class="btn-icon-only icon-edit"></i>
									  </a>
									  <a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'traducao-'.$i->id; ?>">
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
					  <h3 style="text-align:center;" >Não há itens cadastradas</h3>
				  </div>
			  <?php endif; ?>
      </div>
      <div id="tabs-3" >
  			<?php if(!empty($listaES)) : ?>
				  <table class="table table-striped table-bordered">
					  <thead>
						  <tr>
							  <th width="1%" >ID</th>
							  <th width="1%" >Lingua</th>
							  <th width="1%" >Tipo</th>
							  <th width="80%" >Nome</th>
							  <th width="20%" class="td-actions"></th>
						  </tr>
					  </thead>
					  <tbody>
					  <?php 
						  foreach($listaES AS $i) :
                $item = new ItemTraducao();
                $item->selecionarPorId($i->fkItemTraducao);
					  ?>
							  <tr>
								  <td><?php echo $i->id; ?></td>
								  <td><?php echo $i->lang; ?></td>
								  <td><?php echo $item->nome; ?></td>
								  <td><?php echo $i->valor; ?></td>
								  <td class="td-actions">
									  <a title="Editar" href="<?php echo Configuracao::$baseUrl.'traducao/editar/'.$i->id.'-'.Funcao::prepararLink($i->valor).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										  <i class="btn-icon-only icon-edit"></i>
									  </a>
									  <a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'traducao-'.$i->id; ?>">
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
					  <h3 style="text-align:center;" >Não há itens cadastradas</h3>
				  </div>
			  <?php endif; ?>
      </div>
      <div id="tabs-4" >
  			<?php if(!empty($listaNL)) : ?>
				  <table class="table table-striped table-bordered">
					  <thead>
						  <tr>
							  <th width="1%" >ID</th>
							  <th width="1%" >Lingua</th>
							  <th width="1%" >Tipo</th>
							  <th width="80%" >Nome</th>
							  <th width="20%" class="td-actions"></th>
						  </tr>
					  </thead>
					  <tbody>
					  <?php 
						  foreach($listaNL AS $i) :
                $item = new ItemTraducao();
                $item->selecionarPorId($i->fkItemTraducao);
					  ?>
							  <tr>
								  <td><?php echo $i->id; ?></td>
								  <td><?php echo $i->lang; ?></td>
								  <td><?php echo $item->nome; ?></td>
								  <td><?php echo $i->valor; ?></td>
								  <td class="td-actions">
									  <a title="Editar" href="<?php echo Configuracao::$baseUrl.'traducao/editar/'.$i->id.'-'.Funcao::prepararLink($i->valor).Configuracao::$extensaoPadrao; ?>" class="btn btn-small btn-warning">
										  <i class="btn-icon-only icon-edit"></i>
									  </a>
									  <a title="Excluir" href="javascript:;" class="btn btn-small" id="<?php echo 'traducao-'.$i->id; ?>">
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
					  <h3 style="text-align:center;" >Não há itens cadastradas</h3>
				  </div>
			  <?php endif; ?>
      </div>
    </div>
		</div> <!-- /widget-content -->
	</div> <!-- /widget -->
</div> <!-- /span12 -->
