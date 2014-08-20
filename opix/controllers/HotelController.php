<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Hotel.php';

	class HotelController extends Controller {

		private static $viewController = "hotel";
		private static $diretorio = "/../../hoteis/";

		public static function adicionar() {

			$hotel = new Hotel();

			if(!empty($_POST)) {

				$hotel->nome      = $_POST['nome'];

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 10485760 ) {
				        $imagem  = $_FILES["imagem"]["name"];
				        $imagem  = Funcao::gerarNomeImagem($imagem, $hotel->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				       // Funcao::redimensionarImagem($arquivo, null, null); // obs: tamanho width: 960 e height: 360
				        $hotel->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 10MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/adicionar".Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$hotel->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

			}

			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$hotel = new Hotel();
			$hoteis = $hotel->listar(null, 'nome');

			self::$variaveis = array('hoteis'=>$hoteis);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);

		}

		public static function editar() {

			$hotel = new Hotel();
			$hotel->selecionarPorId($_GET['id']);

			if(!empty($_POST)) {

				$hotel->nome      	 = $_POST['nome'];

				if( $_POST['apagar_imagem'] ) {
				    unlink(__DIR__.self::$diretorio.$hotel->imagem);
				}

				if( !empty($_FILES['imagem']['name']) ) {
				    if( filesize($_FILES['imagem']['tmp_name']) <= 10485760 ) {
				        if( ( file_exists(__DIR__.self::$diretorio.$hotel->imagem) && !is_dir(__DIR__.self::$diretorio.$hotel->imagem) ) ) {
				            unlink(__DIR__.self::$diretorio.$hotel->imagem);
				        }
				        $imagem = $_FILES["imagem"]["name"];
				        $imagem = Funcao::gerarNomeImagem($imagem, $hotel->nome);
				        $arquivo = __DIR__.self::$diretorio.$imagem;
				        move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo);
				        //Funcao::redimensionarImagem($arquivo, null, '145'); // obs: tamanho width: 960 e height: 360
				        $hotel->imagem = $imagem;
				    } else {
				        echo "<script>alert('O arquivo que você enviou é maior que 10MB, por favor envie um arquivo de tamanho menor'); document.location.href='".Configuracao::$baseUrl.self::$viewController."/editar/".$hotel->id.'-'.Funcao::prepararLink($hotel->nome).Configuracao::$extensaoPadrao."';</script>";
				        exit;
				    }
				}
				$hotel->salvar();

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('hotel' => $hotel);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);

		}

		public static function excluir() {

			$hotel = new Hotel();
			$hotel->selecionarPorId($_POST['id']);
			$hotel->excluir();

		}

	}
