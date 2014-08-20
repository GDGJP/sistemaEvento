<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/TipoAgricultura.php';
	
	class TipoAgriculturaController extends Controller {
		
		private static $viewController = "tipoAgricultura";
		
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$tipoAgricultura = new TipoAgricultura();				
				$tipoAgricultura->nome = $_POST['nome'];
				$tipoAgricultura->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		} 
		
		public static function listar() {
			$tipoAgricultura = new TipoAgricultura();
			$listaDeTiposAgricultura = $tipoAgricultura->listar();
			self::$variaveis = array('listaDeTiposAgricultura' => $listaDeTiposAgricultura);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$tipoAgricultura = new TipoAgricultura();
			$tipoAgricultura->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$tipoAgricultura->nome = $_POST['nome'];
				$tipoAgricultura->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('tipoAgricultura' => $tipoAgricultura);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$tipoAgricultura = new TipoAgricultura();
			$tipoAgricultura->selecionarPorId($_POST['id']);
			$tipoAgricultura->excluir();
			
		}
		
	}
