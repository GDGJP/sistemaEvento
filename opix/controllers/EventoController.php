<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Evento.php';
	require_once __DIR__.'/../models/Ingresso.php';
	require_once __DIR__.'/../models/Organizador.php';
	
	class EventoController extends Controller {
		
		private static $viewController = "evento";
		
		public static function adicionar() {
				
			$evento = new Evento();
			
			if(!empty($_POST)) {
		
				if( !empty($_FILES["Event"]["name"]["imagem"]) ) {
					$imagem = $_FILES["Event"]["name"]["imagem"];
					$imagem = strtolower(str_replace(" ", "-", $_POST['Event']['nome'])).md5(date('YmdHis')).'.'.pathinfo($imagem, PATHINFO_EXTENSION);
					move_uploaded_file($_FILES['Event']['tmp_name']['imagem'], __DIR__.'/../imagens_evento/'.$imagem);
				}
				
				$usuario = new Usuario();
				$usuario->selecionarPorId($_SESSION['auth']['id']);
				
				$evento->fkUsuario = (!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id'];
				
				foreach( $_POST['Event'] as $atributo => $valor )
					$evento->$atributo = $valor;
				$evento->imagem = $imagem;
				$idEvento = $evento->salvar();
				
				foreach( $_POST['EventHost'] as $host ) {
					$organizador = new Organizador();
					foreach ($host as $indice => $valor ) {
						$organizador->$indice = $host[$indice];
					}
					$organizador->fkEvento = $idEvento;
					$organizador->salvar();
				}
				
				foreach ($_POST['Ticket'] as $ticket) {
					$ingresso = new Ingresso();
					foreach ( $ticket as $indice => $valor ) {
						$ingresso->$indice = $ticket[$indice];
					}
					$ingresso->fkEvento = $idEvento;
					$ingresso->salvar();
				}
				
				self::redirecionar(Configuracao::$baseUrl.'evento/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
		
			$usuario = new Usuario();
			$usuario->selecionarPorId($_SESSION['auth']['id']);
			
			$evento = new Evento();
			$listaDeEventos = $evento->listarPorIdUsuario((!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id']);
//			$listaDeEventos = $evento->listar();
			self::$variaveis = array('listaDeEventos' => $listaDeEventos);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				if( !empty($_FILES["Event"]["name"]["imagem"]) ) {
					$imagem = $_FILES["Event"]["name"]["imagem"];
					$imagem = strtolower(str_replace(" ", "-", $_POST['Event']['nome'])).md5(date('YmdHis')).'.'.pathinfo($imagem, PATHINFO_EXTENSION);
					move_uploaded_file($_FILES['Event']['tmp_name']['imagem'], __DIR__.'/../imagens_evento/'.$imagem);
					unlink(__DIR__.'/../imagens_evento/'.$_POST['Event']['imagem_antiga']);
				}
				
				unset($_POST['Event']['imagem_antiga']);
				
				foreach( $_POST['Event'] as $atributo => $valor )
					$evento->$atributo = $valor;
				$evento->imagem = $imagem;

				$idEvento = $evento->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.'evento/listar'.Configuracao::$extensaoPadrao);
			}
				
			$ingresso = new Ingresso();
			$ingressos = $ingresso->listarPorIdEvento($evento->id);
			$organizador = new Organizador();
			$organizadores = $organizador->listarPorIdEvento($evento->id);
			self::$variaveis = array('evento' => $evento, 'ingressos' => $ingressos, 'organizadores' => $organizadores);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$evento = new Evento();
			$evento->selecionarPorId($_POST['id']);
			$evento->excluir();
			
		}
		
	}
