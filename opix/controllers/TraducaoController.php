<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Traducao.php';
	require_once __DIR__.'/../models/ItemTraducao.php';
	
	class TraducaoController extends Controller {
		
		private static $viewController = "traducao";
		
		public static function adicionar() {
				
			$traducao     = new Traducao();
			$itemTraducao = new ItemTraducao();
			$itens        = $itemTraducao->listar();
		
			if(!empty($_POST)) {
				$traducao->fkItemTraducao  = $_POST['tipotraducao'];
				$traducao->lang            = $_POST['lang'];
				$traducao->valor           = $_POST['valor'];
				$traducao->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}

			self::$variaveis = array('itens' => $itens);
			self::$corpo = "adicionar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function listar() {
			
			$traducao = new Traducao();
			$listaPT  = $traducao->listar(' lang = "pt" ');
			$listaEN  = $traducao->listar(' lang = "en" ');
			$listaES  = $traducao->listar(' lang = "es" ');			
      $listaNL  = $traducao->listar(' lang = "nl" ');

			self::$variaveis = array('listaPT' => $listaPT, 'listaEN' => $listaEN, 'listaES' => $listaES, 'listaNL' => $listaNL);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function editar() {
		
			$traducao = new Traducao();
			$traducao->selecionarPorId($_GET['id']);

			$itemTraducao = new ItemTraducao();
			$itens        = $itemTraducao->listar();
		
			if(!empty($_POST)) {
				
				$traducao->fkItemTraducao = $_POST['tipotraducao'];
				$traducao->lang           = $_POST['lang'];
				$traducao->valor          = $_POST['valor'];
				$traducao->salvar();
				
				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
			}
				
			self::$variaveis = array('traducao' => $traducao, 'itens'=>$itens);
			self::$corpo = "editar";
			self::renderizar(self::$viewController);
				
		}
		
		public static function excluir() {
			
			$traducao = new Traducao();
			$traducao->selecionarPorId($_POST['id']);
			$traducao->excluir();
			
		}

		public static function criararquivo() {
	    	$traducao1 = new Traducao();
	    	$string = $traducao1->gerarStringArquivo($_POST['l']);
	      
	    	$traducao2 = new Traducao();
			$traducao2->criarArquivo($string,$_POST['l']);
	      
	      	header("Location: ".Configuracao::$baseUrl.'traducao/listar'.Configuracao::$extensaoPadrao);
	    }
		
	}
