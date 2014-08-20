<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Organizador.php';
	
	class OrganizadorController extends Controller {
		
		private static $viewController = "organizador";
		
		public static function editarAjax() {
				
			$organizador = new Organizador();
			
			if( !empty($_POST['id']) ) {
				$organizador->selecionarPorId($_POST['id']);
			} else {
				$organizador->fkEvento = $_POST['fk_evento'];
			}
			
			$organizador->nome = $_POST['nome'];
			$organizador->descricao = $_POST['descricao'];
			$objeto = new stdClass();
			
			$retorno = $organizador->salvar();
			
			if( empty($_POST['id']) ) {
				$objeto->idNovoHost = $retorno;
			}
			
			if( $retorno ) {
				$objeto->sucesso = true;
			} else {
				$objeto->sucesso = false;
			}
			
			echo json_encode($objeto);
			
			
				
		}
		
		public static function excluirAjax() {
			
			$organizador = new Organizador();
			$organizador->selecionarPorId($_POST['id']);
			$resposta = new stdClass();			
			$resposta->sucesso = $organizador->excluir();

			echo json_encode($resposta);
			
		}
	}