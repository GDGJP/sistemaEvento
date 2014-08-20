<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Sala.php';
	require_once __DIR__.'/../models/Evento.php';

	require_once __DIR__.'/../components/Funcao.php';
	
	class SalaController extends Controller {
		
		private static $viewController = "sala";
		
		
		public static function adicionar() {
			$sala = new Sala();

			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);

			if(!empty($_POST)) {
				$sala = new Sala();
				foreach($_POST as $pKey=>$p) {
					$sala->$pKey = $p;
				}
				$idSala = $sala->salvar();

				$evento = new Evento();
				$evento->selecionarPorId($_POST['fkEvento']);

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
			}

			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
		}

		public static function listar() {

			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);

			$sala = new Sala();
			$lista  = $sala->listarPorIdEvento($_GET['id']);

			self::$variaveis = array('evento'=>$evento, 'lista' => $lista);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		

		public static function editar() {
		
			$sala = new Sala();
			$sala->selecionarPorId($_GET['id']);

			$evento = new Evento();
			$evento->selecionarPorId($sala->fkEvento);

			if(!empty($_POST)) {
				$sala = new Sala();
				foreach($_POST as $pKey=>$p) {
					$sala->$pKey = $p;
				}
				$idSala = $sala->salvar();

				$evento = new Evento();
				$evento->selecionarPorId($_POST['fkEvento']);

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
			}

			self::$corpo = "editar";
			self::$variaveis = array('sala'=>$sala);
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$voucher = new Voucher();
			$voucher->selecionarPorId($_POST['id']);
			$voucher->excluir();
			
		}
		
	}
