<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Link.php';
	
	class LinkController extends Controller {
		
		private static $viewController = "link";
		
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$link = new Link();				
				$link->titulo = $_POST['titulo'];
				$link->link = $_POST['link'];
				$link->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$link = new Link();
			$listaDeLinks = $link->listar();
			self::$variaveis = array('listaDeLinks' => $listaDeLinks);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$link = new Link();
			$link->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				
				$link->titulo = $_POST['titulo'];
				$link->link = $_POST['link'];
				
				$link->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('link' => $link);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$link = new Link();
			$link->selecionarPorId($_POST['id']);
			$link->excluir();
			
		}
		
	}
