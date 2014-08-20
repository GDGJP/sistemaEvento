<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/AgricultorTipoAgricultura.php';
	require_once __DIR__.'/../models/TipoAgricultura.php';
	require_once __DIR__.'/../models/Agricultor.php';
	
	class AgricultorController extends Controller {
		
		private static $viewController = "agricultor";
		
		public static function adicionar() {
				
			if(!empty($_POST)) {
				$agricultor = new Agricultor();				
				$agricultor->nome = $_POST['nome'];
				$agricultor->telefone = $_POST['telefone'];
				$agricultor->cpf = $_POST['cpf'];
				$idInserido = $agricultor->salvar();

				if( !empty($_POST['agriculturas']) ) {
					foreach( $_POST['agriculturas'] as $agricultura ) {
						$agricultorTipoAgricultura = new AgricultorTipoAgricultura();
						$agricultorTipoAgricultura->fk_agricultor = $idInserido;
						$agricultorTipoAgricultura->fk_tipo_agricultura = $agricultura;
						$agricultorTipoAgricultura->salvar();
					}
				}
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			$tipoAgricultura = new TipoAgricultura();
			$listaDeTiposDeAgriculturas = $tipoAgricultura->listar();
	
			self::$corpo = "adicionar";
			self::$variaveis = array('listaDeTiposDeAgriculturas' => $listaDeTiposDeAgriculturas);
			self::renderizar(self::$viewController);
				
		} 
		
		public static function listar() {
			$agricultor = new Agricultor();
			$listaDeAgricultores = $agricultor->listar();
			self::$variaveis = array('listaDeAgricultores' => $listaDeAgricultores);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$agricultor = new Agricultor();
			$agricultor->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$agricultor->nome = $_POST['nome'];
				$agricultor->telefone = $_POST['telefone'];
				$agricultor->cpf = $_POST['cpf'];
				$agricultor->salvar();

				$agricultorTipoAgricultura = new AgricultorTipoAgricultura();
				$agricultorTiposAgricultura = $agricultorTipoAgricultura->listar('fk_agricultor = '.$_GET['id']);
				foreach( $agricultorTiposAgricultura as $agricultorTipoAgricultura ) {
					$agricultorTipoAgricultura->excluir();
				}

				if( !empty($_POST['agriculturas']) ) {
					foreach( $_POST['agriculturas'] as $agricultura ) {
						$agricultorTipoAgricultura = new AgricultorTipoAgricultura();
						$agricultorTipoAgricultura->fk_agricultor = $_GET['id'];
						$agricultorTipoAgricultura->fk_tipo_agricultura = $agricultura;
						$agricultorTipoAgricultura->salvar();
					}
				}
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			$tipoAgricultura = new TipoAgricultura();
			$listaDeTiposDeAgriculturas = $tipoAgricultura->listar();

			$agricultorTiposAgricultura = $agricultor->getTiposAgricultura();
			
			$listaTiposAgriculturaAgricultor = array();

			foreach( $agricultorTiposAgricultura as $agricultura ) { 
				$listaTiposAgriculturaAgricultor[] = $agricultura->fk_tipo_agricultura;
			}

				
			self::$variaveis = array('agricultor' => $agricultor, 'listaDeTiposDeAgriculturas' => $listaDeTiposDeAgriculturas, 'listaTiposAgriculturaAgricultor' => $listaTiposAgriculturaAgricultor);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$agricultor = new Agricultor();
			$agricultor->selecionarPorId($_POST['id']);
			$agricultor->excluir();
			
		}

		public static function uploadFoto() {

			$id = $_GET['id'];
			$diretorio = __DIR__.'/../galerias_agricultores/'.$id;

			if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				$informacoesArquivo = pathinfo($_FILES['files']['name'][0]);
				$nomeArquivo = $informacoesArquivo['filename'];
				$extensaoArquivo = $informacoesArquivo['extension'];

				if( !is_dir($diretorio) ) {
					mkdir($diretorio);
				}

				$nomeFoto = Funcao::prepararLink($nomeArquivo) . '-' . date('Y-m-d-H-i-s') . '.' . $extensaoArquivo;
				move_uploaded_file($_FILES['files']['tmp_name'][0], $diretorio . '/' . $nomeFoto);

				$resposta = new StdClass();

				$foto = new StdClass();
				$foto->url = Configuracao::$baseUrl . 'galerias_agricultores/' . $id . '/' . $nomeFoto;
				$foto->thumbnailUrl = Configuracao::$baseUrl . 'galerias_agricultores/' . $id . '/' . $nomeFoto;
				$foto->name = $nomeFoto;
				$foto->type = $_FILES['files']['type'][0];
				$foto->size = $_FILES['files']['size'][0];
				$foto->deleteUrl = Configuracao::$baseUrl . 'agricultor/deleteFoto/'.$id.'-delete.html?foto='.$nomeFoto;
				$foto->deleteType = 'POST';

				$resposta->files[] = $foto;

				echo json_encode($resposta);

			} else {
				$resposta = new StdClass();

				$fotos = scandir($diretorio);
				foreach( $fotos as $unFoto ) {
					if( $unFoto != '.' && $unFoto != '..' ) {
						$foto = new StdClass();
						$foto->url = Configuracao::$baseUrl . 'galerias_agricultores/' . $id . '/' . $unFoto;
						$foto->thumbnailUrl = Configuracao::$baseUrl . 'galerias_agricultores/' . $id . '/' . $unFoto;
						$foto->name = $unFoto;
						$foto->type = mime_content_type($diretorio . '/' . $unFoto);
						$foto->size = filesize($diretorio . '/' . $unFoto);
						$foto->deleteUrl = Configuracao::$baseUrl . 'agricultor/deleteFoto/'.$id.'-delete.html?foto='.$unFoto;
						$foto->deleteType = 'POST';

						$resposta->files[] = $foto;
					}
				}

				echo json_encode($resposta);
			}

		}

		public static function deleteFoto() {
			
			$id = $_GET['id'];
			$diretorio = __DIR__.'/../galerias_agricultores/'.$id;

			unlink($diretorio . '/' . $_GET['foto']);

			echo json_encode(true);

		}
		
	}
