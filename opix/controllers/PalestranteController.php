<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Palestrante.php';

	class PalestranteController extends Controller {

		private static $viewController = "palestrante";
		private static $diretorio = "/../../palestrantes/";

		public static function adicionar() {

			$palestrante = new Palestrante();

			if(!empty($_POST)) {

				$palestrante->nome      = $_POST['nome'];
				$palestrante->descricao = $_POST['descricao'];

				if( !empty($_FILES['foto']['name']) ) {
				    if( filesize($_FILES['foto']['tmp_name']) <= 10485760 ) {
				        $foto = $_FILES["foto"]["name"];
				        $foto = Funcao::gerarNomeImagem($foto, $palestrante->nome);
				        $arquivo = __DIR__.self::$diretorio.$foto;
				        move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '200'); // obs: tamanho width: 960 e height: 360
				        $palestrante->foto = $foto;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 10MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/adicionar".Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$palestrante->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

			}

			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$palestrante = new Palestrante();
			$palestrantes = $palestrante->listar(null, 'nome');

			self::$variaveis = array('palestrantes'=>$palestrantes);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);

		}

		public static function editar() {

			$palestrante = new Palestrante();
			$palestrante->selecionarPorId($_GET['id']);

			if(!empty($_POST)) {

				$palestrante->nome      	 = $_POST['nome'];
				$palestrante->descricao      = $_POST['descricao'];

				if( $_POST['apagar_foto'] ) {
				    unlink(__DIR__.self::$diretorio.$palestrante->foto);
				}

				if( !empty($_FILES['foto']['name']) ) {
				    if( filesize($_FILES['foto']['tmp_name']) <= 1048576 ) {
				        if( ( file_exists(__DIR__.self::$diretorio.$palestrante->foto) && !is_dir(__DIR__.self::$diretorio.$palestrante->foto) ) ) {
				            unlink(__DIR__.self::$diretorio.$palestrante->foto);
				        }
				        $foto = $_FILES["foto"]["name"];
				        $foto = Funcao::gerarNomeImagem($foto, $palestrante->nome);
				        $arquivo = __DIR__.self::$diretorio.$foto;
				        move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo);
				        Funcao::redimensionarImagem($arquivo, null, '145'); // obs: tamanho width: 960 e height: 360
				        $palestrante->foto = $foto;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 1MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/editar/".$palestrante->id.'-'.Funcao::prepararLink($palestrante->nome).Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$palestrante->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('palestrante' => $palestrante);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);

		}

		public static function excluir() {

			$palestrante = new Palestrante();
			$palestrante->selecionarPorId($_POST['id']);
			$palestrante->excluir();

		}

	}
