<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Categoria.php';
	
	class CategoriaController extends Controller {
		
		private static $viewController = "categoria";
		
		public static function adicionar() {
				
			$categoria = new Categoria();
			
			if(!empty($_POST)) {
				
				$categoria->nome = $_POST['nome'];
				$categoria->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$categoria = new Categoria();
			$listaDeCategorias = $categoria->listar();
			
			self::$variaveis = array('listaDeCategorias' => $listaDeCategorias);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$categoria = new Categoria();
			$categoria->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				
				$categoria->nome = $_POST['nome'];
				$categoria->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('categoria' => $categoria);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$categoria = new Categoria();
			$categoria->selecionarPorId($_POST['id']);
			$categoria->excluir();
			
		}
		
	}
