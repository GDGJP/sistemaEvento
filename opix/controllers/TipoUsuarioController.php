<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/TipoUsuario.php';
	
	class TipoUsuarioController extends Controller {
		
		private static $viewController = "tipoUsuario";
		
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$usuario = new Usuario();
				$usuario->selecionarPorId($_SESSION['auth']['id']);
			
				$tipoUsuario = new TipoUsuario();				
				$tipoUsuario->nome = $_POST['nome'];
				$tipoUsuario->modulos =  implode('|', $_POST['modulos']);
				$tipoUsuario->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		} 
		
		public static function listar() {
						
			$tipoUsuario = new TipoUsuario();
			$listaDeTiposUsuarios = $tipoUsuario->listar();
			
			self::$variaveis = array('listaDeTiposUsuarios' => $listaDeTiposUsuarios);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$tipoUsuario = new TipoUsuario();
			$tipoUsuario->selecionarPorId($_GET['id']);
			$tipoUsuario->modulos = explode('|', $tipoUsuario->modulos);
		
			if(!empty($_POST)) {
				$tipoUsuario->nome = $_POST['nome'];
				$tipoUsuario->modulos = implode('|', $_POST['modulos']);
				$tipoUsuario->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('tipoUsuario' => $tipoUsuario);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$tipoUsuario = new TipoUsuario();
			$tipoUsuario->selecionarPorId($_POST['id']);
			$tipoUsuario->excluir();
			
		}
		
	}
