<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/RedeSocial.php';
	
	class RedeSocialController extends Controller {
		
		private static $viewController = "redeSocial";
		private static $diretorio = "/../../redes_sociais/";
		/*
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$redeSocial = new RedeSocial();				
				$redeSocial->titulo = $_POST['titulo'];
				$redeSocial->link = $_POST['link'];
				$redeSocial->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		} 
		*/
		
		public static function listar() {
			
			$redeSocial = new RedeSocial();
			$listaDeRedesSociais = $redeSocial->listar();
			self::$variaveis = array('listaDeRedesSociais' => $listaDeRedesSociais);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$redeSocial = new RedeSocial();
			$redeSocial->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$redeSocial->titulo = $_POST['titulo'];
				$redeSocial->link = $_POST['link'];
				if( !empty($_FILES['imagem']['name']) ) {
					if( file_exists(__DIR__.self::$diretorio.$redeSocial->imagem) ) {
						unlink(__DIR__.self::$diretorio.$redeSocial->imagem);
					}
					if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
						$imagem = $_FILES["imagem"]["name"];
						$imagem = Funcao::gerarNomeImagem($imagem, $redeSocial->titulo);
						$arquivo = __DIR__.self::$diretorio.$imagem;
						move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
						$redeSocial->imagem = $imagem;
					} else {
						echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor');</script>";
						exit;
					}
				}
				
				$redeSocial->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('redeSocial' => $redeSocial);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		/*
		public static function excluir() {
			
			$redeSocial = new RedeSocial();
			$redeSocial->selecionarPorId($_POST['id']);
			$redeSocial->excluir();
			
		}*/
		
	}
