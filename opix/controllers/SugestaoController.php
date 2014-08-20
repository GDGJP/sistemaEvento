<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Sugestao.php';
	
	class SugestaoController extends Controller {
		
		private static $viewController = "sugestao";
		
		public static function listar() {
			
			$sugestao = new Sugestao();
			$listaDeSugestoes = $sugestao->listar('', 'status DESC');
			self::$variaveis = array('listaDeSugestoes' => $listaDeSugestoes);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function exportar() {
			
			$sugestao = new Sugestao();
			$listaDeSugestoes = $sugestao->listar();
			self::$variaveis = array('listaDeSugestoes' => $listaDeSugestoes);
			header("Content-type: application/vnd.ms-excel; charset=UTF-8");
			header("Content-type: application/force-download; charset=UTF-8");
			header("Content-Disposition: attachment; filename=listaDeSugestoes.xls");
			header("Pragma: no-cache");
			self::$header = '';
			self::$topo = '';
			self::$menu = '';
			self::$footer = '';
			self::$corpo = "exportar";
			self::renderizar(self::$viewController);
			
		}
		
		public static function status(){
		
			$sugestao = new Sugestao();
			$sugestao->selecionarPorId($_GET['id']);
			$sugestao->status = ($sugestao->status) ? 0 : 1;
			$sugestao->salvar();
			header('Location: '.$_SERVER['HTTP_REFERER']);
		
		}
		
	}
