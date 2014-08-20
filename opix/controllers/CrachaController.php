<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Cracha.php';
	require_once __DIR__.'/../models/Participante.php';
	require_once __DIR__.'/../../components/Util.php';
	require_once __DIR__.'/../components/barcodegen/class/BCGFontFile.php';
	require_once __DIR__.'/../components/barcodegen/class/BCGColor.php';
	require_once __DIR__.'/../components/barcodegen/class/BCGDrawing.php';
	require_once __DIR__.'/../components/barcodegen/class/BCGcode39.barcode.php';
	
	class CrachaController extends Controller {
		
		private static $viewController = "cracha";
		
		public static function listar() {
		
			$cracha = new Cracha();
			$crachas = $cracha->listar('evento = \'br30\'', 'id DESC');
			
			self::$corpo = "listar";
			self::$variaveis = array('crachas' => $crachas);
			self::renderizar(self::$viewController);
			
		}
		
		public static function listarTvEscola() {
		
			$cracha = new Cracha();
			$crachas = $cracha->listar('evento = \'tv-escola\'', 'id DESC');
			
			self::$corpo = "listarTvEscola";
			self::$variaveis = array('crachas' => $crachas);
			self::renderizar(self::$viewController);
			
		}
		
		public static function adicionar() {
		
			$cracha = new Cracha();
			$crachas = $cracha->listar();
			
			if( !empty($crachas) ) {
				$listaIdsCrachas = array();
				foreach( $crachas as $cracha ) {
					$listaIdsCrachas[] = $cracha->fk_participante;
				}
			}	
		
			$participante = new Participante();
			$participantes = $participante->listarPorIdFormulario(17, 'confirmou = 1 AND id NOT IN ('.implode(",", $listaIdsCrachas).')');
		
			if(!empty($_POST)) {
				$nomeCracha = $_POST['nome'];
				$idParticipante = $_POST['idParticipante'];
				$funcao = $_POST['funcao'];
		
				$cracha = new Cracha();
				
				if( !empty($_FILES["foto_cracha"]["name"]) ) {
					$nomeFoto = $idParticipante.'-'.Util::substituiCaracteres($nomeCracha).'.'.pathinfo($_FILES['foto_cracha']['name'], PATHINFO_EXTENSION);

					$foto = WideImage::loadFromUpload('foto_cracha');
					$imagem = $foto->crop($_POST['foto_x'], $_POST['foto_y'], $_POST['foto_w'], $_POST['foto_h']);
					@unlink('../fotosParticipantes/'.$nomeFoto);
					$imagem->saveToFile('../fotosParticipantes/'.$nomeFoto);
					
					$cracha->foto = $nomeFoto;
				}
				
				$cracha->nome = $nomeCracha;
				$cracha->funcao = $funcao;
				$cracha->fk_participante = $idParticipante;
				$cracha->salvar();
			
				self::redirecionar(Configuracao::$baseUrl.'cracha/listar'.Configuracao::$extensaoPadrao);
			}
			
			self::$variaveis = array('participantes' => $participantes);	
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function editar() {
		
			$cracha = new Cracha();
			$cracha->selecionarPorId($_GET['id']);
		
			if(!empty($_POST)) {
				$nomeCracha = $_POST['nome'];
				$idParticipante = $_POST['idParticipante'];
				$funcao = $_POST['funcao'];
				
				if( !empty($_FILES["foto_cracha"]["name"]) ) {
					$nomeFoto = $idParticipante.'-'.Util::substituiCaracteres($nomeCracha).'.'.pathinfo($_FILES['foto_cracha']['name'], PATHINFO_EXTENSION);

					$foto = WideImage::loadFromUpload('foto_cracha');
					$imagem = $foto->crop($_POST['foto_x'], $_POST['foto_y'], $_POST['foto_w'], $_POST['foto_h']);
					@unlink('../fotosParticipantes/'.$nomeFoto);
					$imagem->saveToFile('../fotosParticipantes/'.$nomeFoto);
					
					$cracha->foto = $nomeFoto;
				}
				
				$cracha->nome = $nomeCracha;
				$cracha->funcao = $funcao;
				$cracha->fk_participante = $idParticipante;
				$cracha->salvar();
			
				self::redirecionar(Configuracao::$baseUrl.'cracha/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('cracha' => $cracha);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function confirmarPresenca() {
			
			$cracha = new Cracha();
			$cracha->selecionarPorId($_GET['id']);
			$cracha->presente = 1;
			$cracha->salvar();
			
			header('Location: '.$_SERVER['HTTP_REFERER']);	
			
		}
		
		public static function negarPresenca() {
			
			$cracha = new Cracha();
			$cracha->selecionarPorId($_GET['id']);
			$cracha->presente = 0;
			$cracha->salvar();
			
			header('Location: '.$_SERVER['HTTP_REFERER']);	
			
		}
		
		public static function imprimir() {
			
			$cracha = new Cracha();
			$cracha->selecionarPorId($_GET['id']);
			
			$color_black = new BCGColor(0, 0, 0);
			$color_white = new BCGColor(255, 255, 255);
			
			$font = new BCGFontFile(__DIR__.'/../components/barcodegen/font/Arial.ttf', 18);
			
			$code = new BCGcode39(); // Or another class name from the manual
			$code->setScale(2); // Resolution
			$code->setThickness(30); // Thickness
			$code->setForegroundColor($color_black); // Color of bars
			$code->setBackgroundColor($color_white); // Color of spaces
			$code->setFont($font); // Font (or 0)
			$code->parse(str_pad($_GET['id'], 4, "0", STR_PAD_LEFT)); // Text
			$code->clearLabels();
			
			ob_start();
			
			$drawing = new BCGDrawing('', $color_white);
			$drawing->setBarcode($code);
			$drawing->draw();
			header('Content-Type: image/png');
			$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
			
			$codigoDeBarras = ob_get_contents();
			
			ob_end_clean();
			
			header('Content-Type: text/html;');
			
			self::$variaveis = array('cracha' => $cracha, 'codigoDeBarras' => $codigoDeBarras);
			self::$header = '';
			self::$topo = '';
			self::$menu = '';
			self::$corpo = 'imprimir';
			self::$footer = '';
			self::renderizar(self::$viewController);
			
		}
		
		public static function quantidadeImpressos() {
		
			self::$corpo = "quantidadeImpressos";
			self::renderizar(self::$viewController);
		
		}
		
		public static function imprimirTodos() {
		
			$cracha = new Cracha();
			
			if( $_POST['funcao'] == 'todas' ) {
				$crachas = $cracha->listar('evento = \'br30\'', 'nome');
			} else {
				$crachas = $cracha->listar('evento = \'br30\' AND funcao = \''.$_POST['funcao'].'\'', 'nome');
			}
			
			$inicio = !empty($_POST['inicio']) ? $_POST['inicio'] : 0;
			$totalParaImpressao = !empty($_POST['quantidade']) ? $_POST['quantidade'] : 500;
			
			$crachas = array_slice($crachas, $inicio, $totalParaImpressao);
			
			$totalPaginas = ceil(count($crachas) / 10);
			
			$divisaoCrachas = array();
			for( $i = 1; $i <= $totalPaginas; $i++ ) {
				$divisaoCrachas[$i] = array_slice($crachas, ($i - 1) * 10, 10);
			}
			
			$divisaoCrachasTemp = array();
			foreach( $divisaoCrachas as $indice => $unDivisaoCrachas ) {
				for( $i = 1; $i <= 5; $i++ ) {
					$divisaoCrachasTemp[$indice][$i] = array_slice($unDivisaoCrachas, ($i - 1) * 2, 2);
				}
			}
			
			$divisaoCrachas = $divisaoCrachasTemp;
			
			$codigosDeBarras = array();
			foreach( $crachas as $cracha ) {
				$color_black = new BCGColor(0, 0, 0);
				$color_white = new BCGColor(255, 255, 255);
			
				$font = new BCGFontFile(__DIR__.'/../components/barcodegen/font/Arial.ttf', 18);
			
				$code = new BCGcode39(); // Or another class name from the manual
				$code->setScale(2); // Resolution
				$code->setThickness(30); // Thickness
				$code->setForegroundColor($color_black); // Color of bars
				$code->setBackgroundColor($color_white); // Color of spaces
				$code->setFont($font); // Font (or 0)
				$code->parse(str_pad($cracha->fk_participante, 4, "0", STR_PAD_LEFT)); // Text
//				$code->clearLabels();
			
				ob_start();
			
				$drawing = new BCGDrawing('', $color_white);
				$drawing->setBarcode($code);
				$drawing->draw();
				header('Content-Type: image/png');
				$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
			
				$codigosDeBarras[$cracha->id] = ob_get_contents();
			
				ob_end_clean();
				
				ob_start();
				
			}
			
			header('Content-Type: text/html;');
			
			self::$header = '';
			self::$topo = '';
			self::$menu = '';
			self::$corpo = "imprimirTodos";
			self::$footer = '';
			self::$variaveis = array('divisaoCrachas' => $divisaoCrachas, 'codigosDeBarras' => $codigosDeBarras);
			self::renderizar(self::$viewController);
		
		}
		
		public static function selecionarParaImpressao() {
			
			$cracha = new Cracha();
			$crachas = $cracha->listar(null, 'nome');
			
			self::$corpo = "selecionarParaImpressao";
			self::$variaveis = array('crachas' => $crachas);
			self::renderizar(self::$viewController);
			
		}
		
		public static function imprimirSelecionados() {
		
			ini_set("display_errors", "off");
		
			$cracha = new Cracha();
			$crachas = $cracha->listar('evento = \'br30\' AND id IN ('.implode(",",$_POST['idsCrachas']).')', 'nome');
			
			$posicaoInicio = $_POST['posicao'];
			
			$totalPaginas = ceil(count($crachas) / 10);
			
			for($i = 1; $i < $posicaoInicio; $i++ ) {
				array_unshift($crachas, array());
			}
			
			$divisaoCrachas = array();
			for( $i = 1; $i <= $totalPaginas; $i++ ) {
				$divisaoCrachas[$i] = array_slice($crachas, ($i - 1) * 10, 10);
			}
			
			$divisaoCrachasTemp = array();
			foreach( $divisaoCrachas as $indice => $unDivisaoCrachas ) {
				for( $i = 1; $i <= 5; $i++ ) {
					$divisaoCrachasTemp[$indice][$i] = (!empty($unDivisaoCrachas)) ? array_slice($unDivisaoCrachas, ($i - 1) * 2, 2) : array('teste1','teste2');
				}
			}
			
			$divisaoCrachas = $divisaoCrachasTemp;
			
			$codigosDeBarras = array();
			foreach( $crachas as $cracha ) {
				$color_black = new BCGColor(0, 0, 0);
				$color_white = new BCGColor(255, 255, 255);
			
				$font = new BCGFontFile(__DIR__.'/../components/barcodegen/font/Arial.ttf', 18);
			
				$code = new BCGcode39(); // Or another class name from the manual
				$code->setScale(2); // Resolution
				$code->setThickness(30); // Thickness
				$code->setForegroundColor($color_black); // Color of bars
				$code->setBackgroundColor($color_white); // Color of spaces
				$code->setFont($font); // Font (or 0)
				$code->parse(str_pad($cracha->fk_participante, 4, "0", STR_PAD_LEFT)); // Text
//				$code->clearLabels();
			
				ob_start();
			
				$drawing = new BCGDrawing('', $color_white);
				$drawing->setBarcode($code);
				$drawing->draw();
				header('Content-Type: image/png');
				$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
			
				$codigosDeBarras[$cracha->id] = ob_get_contents();
			
				ob_end_clean();
				
				ob_start();
				
			}
			
			header('Content-Type: text/html;');
			
			self::$header = '';
			self::$topo = '';
			self::$menu = '';
			self::$corpo = "imprimirSelecionados";
			self::$footer = '';
			self::$variaveis = array('divisaoCrachas' => $divisaoCrachas, 'codigosDeBarras' => $codigosDeBarras, 'posicaoInicio' => $posicaoInicio);
			self::renderizar(self::$viewController);
		
		}
		
	}
