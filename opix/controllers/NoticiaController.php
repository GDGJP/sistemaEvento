<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Noticia.php';
	require_once __DIR__.'/../models/Categoria.php';

	class NoticiaController extends Controller {

		private static $viewController = "noticia";
		private static $diretorio = "/../../noticias/";

		public static function adicionar() {

			$noticia = new Noticia();
			$categoria = new Categoria();
			$categorias = $categoria->listar();

			if(!empty($_POST)) {

				$noticia->fkCategoria = $_POST['categoria'];
				$noticia->titulo      = $_POST['titulo'];
				$noticia->resumo      = $_POST['resumo'];
				$noticia->texto       = $_POST['texto'];
				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $noticia->titulo);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '145'); // obs: tamanho width: 960 e height: 360
				        $noticia->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/adicionar".Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$noticia->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

			}

			self::$corpo = "adicionar";
			self::$variaveis = array('categorias' => $categorias);
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$noticia = new Noticia();
			$noticias = $noticia->listar();

			self::$variaveis = array('noticias'=>$noticias);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);

		}

		public static function editar() {

			$noticia = new Noticia();
			$noticia->selecionarPorId($_GET['id']);
			$categoria = new Categoria();
			$categorias = $categoria->listar();

			if(!empty($_POST)) {

				$noticia->fkCategoria = $_POST['categoria'];
				$noticia->titulo      = $_POST['titulo'];
				$noticia->resumo      = $_POST['resumo'];
				$noticia->texto       = $_POST['texto'];

				if( $_POST['apagar_imagem'] ) {
				    unlink(__DIR__.self::$diretorio.$noticia->imagem);
				}

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
				        if( ( file_exists(__DIR__.self::$diretorio.$noticia->imagem) && !is_dir(__DIR__.self::$diretorio.$noticia->imagem) ) ) {
				            unlink(__DIR__.self::$diretorio.$noticia->imagem);
				        }
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $noticia->titulo);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '145'); // obs: tamanho width: 960 e height: 360
				        $noticia->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/editar/".$noticia->id.'-'.Funcao::prepararLink($noticia->titulo).Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$noticia->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('noticia' => $noticia, 'categorias' => $categorias);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);

		}

		public static function excluir() {

			$noticia = new Noticia();
			$noticia->selecionarPorId($_POST['id']);
			$noticia->excluir();

		}

		public static function status() {

			$noticia = new Noticia();
			$noticia->selecionarPorId($_POST['id']);
			$noticia->destacado = !$noticia->destacado;
			$noticia->salvar();

		}

	}
