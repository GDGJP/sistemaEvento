<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Evento.php';
	require_once __DIR__.'/../models/Certificado.php';
	
	class CertificadoController extends Controller {
		
		private static $viewController = "certificado";
		
		public static function adicionar() {
				
			$certificado = new Certificado();
			
			if(!empty($_POST)) {
				
				$certificado->nome = $_POST['nome'];
				$certificado->texto = $_POST['texto'];
				$certificado->fkEvento = $_GET['id'];
				$certificado->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);
			
			$certificado = new Certificado();
			$listaDeCertificados = $certificado->listarPorIdEvento($_GET['id']);
			
			self::$variaveis = array('listaDeCertificados' => $listaDeCertificados, 'evento' => $evento);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$certificado = new Certificado();
			$certificado->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				
				$certificado->nome = $_POST['nome'];
				$certificado->texto = $_POST['texto'];
				$certificado->fkEvento = $_POST['id'];
				$certificado->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('certificado' => $certificado);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$certificado = new Certificado();
			$certificado->selecionarPorId($_POST['id']);
			$certificado->excluir();
			
		}
		
	}
