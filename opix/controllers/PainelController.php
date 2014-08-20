<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Painel.php';
	
	class PainelController extends Controller {
		
		private static $viewController = "painel";
		private static $diretorio = '/../../painel/';
		
		public static function adicionar() {
				
			$painel = new Painel();
			
			if(!empty($_POST)) {
				$usuario = new Usuario();
				$usuario->selecionarPorId($_SESSION['auth']['id']);
				
				$painel->nome      = $_POST['nome'];
				$painel->lang      = $_POST['lang'];
				$painel->fkUsuario = (!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id'];
				if( !empty($_FILES['imagem']['name']) ) {
					if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
						$imagem = $_FILES["imagem"]["name"];
						$imagem = Funcao::gerarNomeImagem($imagem, $painel->nome);
						$arquivo = __DIR__.self::$diretorio.$imagem;
						move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
						Funcao::redimensionarImagem($arquivo, '100%','100%'); // obs: tamanho width: 960 e height: 360
						$painel->imagem = $imagem;
					} else {
						echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor');</script>";
						exit;
					}
				}
				$painel->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			$usuario = new Usuario();
			$usuario->selecionarPorId($_SESSION['auth']['id']);
			
			$painel = new Painel();
			$listaDePaineis = $painel->listar('fkUsuario = '.(!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id']);
			self::$variaveis = array('listaDePaineis' => $listaDePaineis);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$painel = new Painel();
			$painel->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$painel->nome = $_POST['nome'];
				$painel->lang = $_POST['lang'];
				if( !empty($_FILES['imagem']['name']) ) {
					if( file_exists(__DIR__.self::$diretorio.$painel->imagem) ) {
						unlink(__DIR__.self::$diretorio.$painel->imagem);
					}
					if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
						$imagem = $_FILES["imagem"]["name"];
						$imagem = Funcao::gerarNomeImagem($imagem, $painel->nome);
						$arquivo = __DIR__.self::$diretorio.$imagem;
						move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
//						Funcao::redimensionarImagem($arquivo, 960, 260); // obs: tamanho width: 960 e height: 360
						Funcao::redimensionarImagem($arquivo, '100%','100%'); // obs: tamanho width: 960 e height: 360 
						$painel->imagem = $imagem;
					} else {
						echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor');</script>";
						exit;
					}
				}
				$painel->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('painel' => $painel);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$painel = new Painel();
			$painel->selecionarPorId($_POST['id']);
			if( file_exists(__DIR__.self::$diretorio.$painel->imagem) ) {
				unlink(__DIR__.self::$diretorio.$painel->imagem);
			}
			$painel->excluir();
			
		}
		
	}
