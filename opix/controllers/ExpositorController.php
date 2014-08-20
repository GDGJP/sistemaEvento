<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Expositor.php';

	class ExpositorController extends Controller {

		private static $viewController = "expositor";
		private static $diretorio = "/../../expositores/";

		public static function adicionar() {

			$expositor = new Expositor();

			if(!empty($_POST)) {

				$expositor->nome      = $_POST['nome'];
				$expositor->link      = $_POST['link'];
				$expositor->posicao = $expositor->getUltimaPosicao() + 1;

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 10485760 ) {
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $expositor->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '100'); // obs: tamanho width: 960 e height: 360
				        $expositor->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/adicionar".Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$expositor->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

			}

			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$expositor = new Expositor();
			$expositores = $expositor->listar(null, 'posicao');

			self::$variaveis = array('expositores'=>$expositores);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);

		}

		public static function editar() {

			$expositor = new Expositor();
			$expositor->selecionarPorId($_GET['id']);

			if(!empty($_POST)) {

				$expositor->nome      = $_POST['nome'];
				$expositor->link      = $_POST['link'];

				if( $_POST['apagar_imagem'] ) {
				    unlink(__DIR__.self::$diretorio.$expositor->imagem);
				}

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 1048576 ) {
				        if( ( file_exists(__DIR__.self::$diretorio.$expositor->imagem) && !is_dir(__DIR__.self::$diretorio.$expositor->imagem) ) ) {
				            unlink(__DIR__.self::$diretorio.$expositor->imagem);
				        }
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $expositor->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, '172', '86'); // obs: tamanho width: 960 e height: 360
				        $expositor->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/editar/".$expositor->id.'-'.Funcao::prepararLink($expositor->nome).Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$expositor->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('expositor' => $expositor);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);

		}

		public static function atualizaPosicoes() {

			if( !empty($_POST['posicoes']) ) {

				$posicoes = $_POST['posicoes'];
				$expositor = new Expositor();
				foreach( $posicoes as $posicao => $id ) {
					$expositor->selecionarPorId($id);
					$expositor->posicao = $posicao;
					$expositor->salvar();
				}

			}

		}

		public static function atualizarMapa() {

			if( !empty($_FILES['mapa']['name']) ) {
				$diretorio = __DIR__.'/../../img/';
				@unlink($diretorio.'mapa.jpg');
				move_uploaded_file($_FILES['mapa']['tmp_name'], $diretorio.'mapa.jpg');
				Funcao::redimensionarImagem($diretorio.'mapa.jpg', '860', '491'); // obs: tamanho width: 960 e height: 360
			}

			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
		}

		public static function excluir() {

			$expositor = new Expositor();
			$expositor->selecionarPorId($_POST['id']);
			$expositor->excluir();

		}

	}
