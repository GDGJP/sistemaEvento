<?php
	class Configuracao {

		public static $baseUrl = "http://caminhoDoSite/opix";
		public static $itensMenu = array(
									'seus_dados' => array(
										'icone' => 'icon-user',
										'link' => 'usuario',
										'label' => 'Seus Dados',
										'sub_itens' => array(
											'editar' => array('link' => 'editar', 'label' => 'Editar'),
										)
									),
									'noticias' => array(
											'icone' => 'icon-list',
											'link' => 'noticia',
											'label' => 'Noticias',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'categorias' => array(
											'icone' => 'icon-list',
											'link' => 'categoria',
											'label' => 'Categorias',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
      		        'textos' => array(
      		                'icone' => 'icon-list',
      		                'link' => 'texto',
      		                'label' => 'Textos',
      		                'sub_itens' => array(
      		                        'listar' => array('link' => 'listar', 'label' => 'Listar'),
      		                        'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
      		                )
      		        ),
      		        'apoios' => array(
      		                'icone' => 'icon-list',
      		                'link' => 'apoio',
      		                'label' => 'Apoios',
      		                'sub_itens' => array(
      		                        'listar' => array('link' => 'listar', 'label' => 'Listar'),
      		                        'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
      		                )
      		        ),
									'palestrantes' => array(
											'icone' => 'icon-user',
											'link' => 'palestrante',
											'label' => 'Palestrantes',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'hoteis' => array(
											'icone' => 'icon-plane',
											'link' => 'hotel',
											'label' => 'Hotéis',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'expositores' => array(
											'icone' => 'icon-user',
											'link' => 'expositor',
											'label' => 'Expositores',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'participantes' => array(
											'icone' => 'icon-user',
											'link' => 'participante',
											'label' => 'Participantes',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'listar_nova' => array('link' => 'listar_nova', 'label' => 'Listar para confirmação'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
                  'voucher' => array(
											'icone' => 'icon-money',
											'link' => 'voucher',
											'label' => 'Voucher',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'usuarios' => array(
											'icone' => 'icon-user',
											'link' => 'usuario',
											'label' => 'Usuários',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									),
									'tiposUsuarios' => array(
											'icone' => 'icon-list',
											'link' => 'tipoUsuario',
											'label' => 'Tipos de Usuários',
											'sub_itens' => array(
													'listar' => array('link' => 'listar', 'label' => 'Listar'),
													'adicionar' => array('link' => 'adicionar', 'label' => 'Adicionar')
											)
									)
		);

		public static $extensaoPadrao = ".html";

	}
