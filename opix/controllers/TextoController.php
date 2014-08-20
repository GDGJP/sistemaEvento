<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Texto.php';
	
	class TextoController extends Controller {
		
		private static $viewController = "texto";
		
		public static function adicionar() {
				
			$texto = new Texto();
			
			if(!empty($_POST)) {
				
				$texto->titulo = $_POST['titulo'];
				$texto->texto = $_POST['texto'];
				$texto->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$texto = new Texto();
			$listaDeTextos = $texto->listar(null, 'id');
			
			self::$variaveis = array('listaDeTextos' => $listaDeTextos);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$texto = new Texto();
			$texto->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				
				$texto->titulo = $_POST['titulo'];
				$texto->texto = $_POST['texto'];
				$texto->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('texto' => $texto);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$texto = new Texto();
			$texto->selecionarPorId($_POST['id']);
			$texto->excluir();
			
		}
		
	}
