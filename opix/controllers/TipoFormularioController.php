<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/TipoFormulario.php';
	
	class TipoFormularioController extends Controller {
		
		private static $viewController = "tipoFormulario";
		
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$usuario = new Usuario();
				$usuario->selecionarPorId($_SESSION['auth']['id']);
			
				$tipoFormulario = new TipoFormulario();				
				$tipoFormulario->nome = $_POST['nome'];
				$tipoFormulario->certificado = (!empty($_POST['certificado'])) ? 1 : 0;
				$tipoFormulario->fkUsuario = (!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id'];
				$tipoFormulario->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		} 
		
		public static function listar() {
			$usuario = new Usuario();
			$usuario->selecionarPorId($_SESSION['auth']['id']);
			
			$tipoFormulario = new TipoFormulario();
			$listaDeTiposFormularios = $tipoFormulario->listar('fkUsuario = '.(!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id']);
			self::$variaveis = array('listaDeTiposFormularios' => $listaDeTiposFormularios);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$tipoFormulario = new TipoFormulario();
			$tipoFormulario->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$tipoFormulario->nome = $_POST['nome'];
				$tipoFormulario->certificado = (!empty($_POST['certificado'])) ? 1 : 0;
				$tipoFormulario->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('tipoFormulario' => $tipoFormulario);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$tipoFormulario = new TipoFormulario();
			$tipoFormulario->selecionarPorId($_POST['id']);
			$tipoFormulario->excluir();
			
		}
		
	}
