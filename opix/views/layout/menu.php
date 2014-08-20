<?php require_once __DIR__.'/../../models/TipoUsuario.php'; ?>
<div class="subnavbar">
	<div class="subnavbar-inner">
	
		<div class="container">

			<a class="btn-subnavbar collapsed" data-toggle="collapse" data-target=".subnav-collapse">
				<i class="icon-reorder"></i>
			</a>

			<div class="subnav-collapse collapse">
				<ul class="mainnav">
					<li>					
						<a href="<?php echo Configuracao::$baseUrl.'index'.Configuracao::$extensaoPadrao; ?>" >
							<i class="icon-home"></i>
							<span>Home</span>
						</a>			
					</li>
					<?php
						$usuario = new Usuario();
						$usuario->selecionarPorId($_SESSION['auth']['id']); 
						$tipoUsuario = new TipoUsuario();
						$tipoUsuario->selecionarPorId($usuario->fkTipoUsuario);
						$modulosPermitidos = array_merge(explode('|', $tipoUsuario->modulos));
						$itensMenu = Configuracao::$itensMenu;
						foreach( $itensMenu as $indice => $item ) : 
							if( !in_array($indice, $modulosPermitidos) ) continue;
							if(!empty($item['sub_itens'])) :
								$atributosItemLista = 'dropdown'; 
								$atributosLink = 'href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"'; 
								$htmlSetaDropdown = '<b class="caret"></b>';
							else :
								$atributosItemLista = ''; 
								$atributosLink = 'href="'.Configuracao::$baseUrl.$item['link'].Configuracao::$extensaoPadrao.'"';
								$htmlSetaDropdown = '';
							endif; 
						?>
					
						<li class="<?php echo $atributosItemLista; ?>">					
							<a <?php echo $atributosLink; ?> >
								<i class="<?php echo $item['icone']; ?>"></i>
								<span><?php echo $item['label']; ?></span>
								<?php echo $htmlSetaDropdown; ?>
							</a>	    
							<?php if( !empty($item['sub_itens']) ) : ?>				
								<ul class="dropdown-menu">
								<?php foreach( $item['sub_itens'] as $indice => $subItem ) : ?>
									<li><a href="<?php echo Configuracao::$baseUrl.$item['link'].'/'.$subItem['link'].Configuracao::$extensaoPadrao; ?>"><?php echo $subItem['label']; ?></a></li>
								<?php endforeach; ?>
								</ul>
							<?php endif; ?> 				
						</li>
					<?php endforeach; ?>
					<li>					
						<a href="<?php echo Configuracao::$baseUrl.'sair'.Configuracao::$extensaoPadrao; ?>" >
							<i class="icon-off"></i>
							<span>Sair</span>
						</a>			
					</li>
				</ul>
			</div> <!-- /.subnav-collapse -->

		</div> <!-- /container -->
	
	</div> <!-- /subnavbar-inner -->

</div> <!-- /subnavbar -->
<div class="main">

    <div class="container">

      <div>

