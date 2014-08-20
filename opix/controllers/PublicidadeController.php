<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Publicidade.php';
	require_once __DIR__.'/../models/Foto.php';
	
	class PublicidadeController extends Controller {
		
		private static $viewController = "publicidade";
		private static $diretorio = '/../../publicidade/';
		
		public static function adicionar() {
			
			if(!empty($_POST)) {
				$usuario = new Usuario();
				$usuario->selecionarPorId($_SESSION['auth']['id']);
			
				$publicidade = new Publicidade();
				$publicidade->nome = $_POST['nome'];
				$publicidade->fkUsuario = (!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id'];
				$idPublicidade = $publicidade->salvar();
				
				if( !empty($_FILES['imagem']['name']) ) {
				
					foreach( $_FILES['imagem']['name'] as $indice => $valor ) {
						if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
							$imagem = $valor;
							$imagem = Funcao::gerarNomeImagem($imagem, $publicidade->nome);
							$arquivo = __DIR__.self::$diretorio.$imagem;
							move_uploaded_file($_FILES['imagem']['tmp_name'][$indice], $arquivo);
							Funcao::redimensionarImagem($arquivo, 300, 300); // obs: tamanho width: 80 e height: 80
							$foto = new Foto();
							$foto->arquivo = $imagem;
							$foto->link = $_POST['link'][$indice];
							$foto->fkPublicidade = $idPublicidade;
							$foto->salvar();
						} else {
							echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor');</script>";
							exit;
						}
					}
				
				}
				
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			$usuario = new Usuario();
			$usuario->selecionarPorId($_SESSION['auth']['id']);
			
			$publicidade = new Publicidade();
			$listaDePublicidades = $publicidade->listar('fkUsuario = '.(!empty($usuario->fkUsuario)) ? $usuario->fkUsuario : $_SESSION['auth']['id']);
			
			self::$variaveis = array('listaDePublicidades' => $listaDePublicidades);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$publicidade = new Publicidade();
			$publicidade->selecionarPorId($_GET['id']);
			
			if(!empty($_POST)) {
				$publicidade->nome = $_POST['nome'];
				foreach( $_FILES['imagem']['name'] as $indice => $valor ) {
					if( !empty($_FILES['imagem']['name'][$indice]) ) {
						$foto = new Foto();
						if( !empty($_POST['imagem_antiga_'.$indice]) ) {
							$foto->selecionarPorId($indice);
							if( file_exists(__DIR__.self::$diretorio.$foto->imagem) ) {
								unlink(__DIR__.self::$diretorio.$foto->imagem);
							}
						} 
						if( filesize($_FILES['imagem']['tmp_name'][$indice]) <= 1048576 ) {
							$imagem = $_FILES["imagem"]["name"][$indice];
							$imagem = Funcao::gerarNomeImagem($imagem, $publicidade->nome);
							$arquivo = __DIR__.self::$diretorio.$imagem;
							move_uploaded_file($_FILES['imagem']['tmp_name'][$indice], $arquivo);
							Funcao::redimensionarImagem($arquivo, 300, 300); // obs: tamanho width: 80 e height: 80
							$foto->arquivo = $imagem;
							$foto->link = $_POST['link'][$indice];
							$foto->fkPublicidade = $publicidade->id;
							$foto->salvar();
						} else {
							echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor');</script>";
							exit;
						}
					} 
				}
				
				if( !empty($_POST['link']) ) {
					foreach( $_POST['link'] as $indice => $valor ) {  
						$foto = new Foto();
						$foto->selecionarPorId($indice);
						$foto->link = $_POST['link'][$indice];
						$foto->salvar();
					}
				}
				
				if( !empty($_POST['ordem']) ) {
					foreach( $_POST['ordem'] as $indice => $valor ) {  
						$foto = new Foto();
						$foto->selecionarPorId($indice);
						$foto->ordem = $_POST['ordem'][$indice];
						$foto->salvar();
					}
				}
				
				$publicidade->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
			
			$foto = new Foto();
			$fotos = $foto->listar('fkPublicidade = '.$publicidade->id);
				
			self::$variaveis = array('publicidade' => $publicidade, 'fotos' => $fotos);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$publicidade = new Publicidade();
			$publicidade->selecionarPorId($_POST['id']);
			$publicidade->excluir();
			
		}
		
	}
