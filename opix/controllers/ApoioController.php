<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Apoio.php';

	class ApoioController extends Controller {

		private static $viewController = "apoio";
		private static $diretorio = "/../../apoios/";

		public static function adicionar() {

			$apoio = new Apoio();

			if(!empty($_POST)) {

				$apoio->nome      = $_POST['nome'];
				$apoio->link     = $_POST['link'];
				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $apoio->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '100'); // obs: tamanho width: 960 e height: 360
				        $apoio->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/adicionar".Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$apoio->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

			}

			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$apoio = new Apoio();
			$apoios = $apoio->listar();

			self::$variaveis = array('apoios'=>$apoios);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);

		}

		public static function editar() {

			$apoio = new Apoio();
			$apoio->selecionarPorId($_GET['id']);

			if(!empty($_POST)) {

				$apoio->nome      = $_POST['nome'];
				$apoio->link      = $_POST['link'];

				if( $_POST['apagar_imagem'] ) {
				    unlink(__DIR__.self::$diretorio.$apoio->imagem);
				}

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
				        if( ( file_exists(__DIR__.self::$diretorio.$apoio->imagem) && !is_dir(__DIR__.self::$diretorio.$apoio->imagem) ) ) {
				            unlink(__DIR__.self::$diretorio.$apoio->imagem);
				        }
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $apoio->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '145'); // obs: tamanho width: 960 e height: 360
				        $apoio->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/editar/".$apoio->id.'-'.Funcao::prepararLink($apoio->nome).Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$apoio->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('apoio' => $apoio);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);

		}

		public static function excluir() {

			$apoio = new Apoio();
			$apoio->selecionarPorId($_POST['id']);
			$apoio->excluir();

		}

	}
