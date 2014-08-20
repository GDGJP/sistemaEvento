<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Email.php';
	
	class EmailController extends Controller {
		
		private static $viewController = "email";
		
		public static function adicionar() {	
				
			if(!empty($_FILES)) {
				$emails = file_get_contents($_FILES['arquivo']['tmp_name']);
				$emails = explode("\n", $emails);
				$contador = 0;
				foreach( $emails as $unidadeEmail ) {
					if( strpos($unidadeEmail,"@") !== false ) {
						$email = new Email();				
						$email->email = $unidadeEmail;
						$email->salvar();
						$contador++;
					}
					
				}
				
				echo "<script>alert('Foram importados ".$contador." emails!'); window.location.href='".Configuracao::$baseUrl.self::$viewController.'/adicionar'.Configuracao::$extensaoPadrao."'</script>";
				
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
	/*
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
			
		} */
		
	}
