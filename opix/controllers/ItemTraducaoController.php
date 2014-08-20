<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/ItemTraducao.php';
	
	class ItemTraducaoController extends Controller {
		
		private static $viewController = "itemTraducao";
		
		public static function adicionar() {
				
			$item = new ItemTraducao();
			
			if(!empty($_POST)) {
				$item->nome = $_POST['nome'];
				$item->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$item = new ItemTraducao();
			$lista = $item->listar();
			self::$variaveis = array('lista' => $lista);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$item = new ItemTraducao();
			$item->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				
				$item->nome = $_POST['nome'];
				$item->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('item' => $item);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$item = new ItemTraducao();
			$item->selecionarPorId($_POST['id']);
			$item->excluir();
			
		}
		
	}
