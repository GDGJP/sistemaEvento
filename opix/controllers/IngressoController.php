<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Ingresso.php';
	
	class IngressoController extends Controller {
		
		private static $viewController = "ingresso";
		
		public static function editarAjax() {
				
			$ingresso = new Ingresso();
			
			if( !empty($_POST['id']) ) {
				$ingresso->selecionarPorId($_POST['id']);
			} else {
				$ingresso->fkEvento = $_POST['fk_evento'];
			}
			
			$ingresso->tipoIngresso = $_POST['tipo'];
			$ingresso->preco = $_POST['valor'];
			$ingresso->quantidade = $_POST['quantidade'];
			$ingresso->descricao = $_POST['descricao'];
			$ingresso->dataInicio = $_POST['inicio_vendas'];
			$ingresso->dataFim = $_POST['termino_vendas'];
			$ingresso->restrito = $_POST['restrito'];
			$objeto = new stdClass();
			
			$retorno = $ingresso->salvar();
			
			if( empty($_POST['id']) ) {
				$objeto->idNovoIngresso = $retorno;
			}
			
			if( $retorno ) {
				$objeto->sucesso = true;
			} else {
				$objeto->sucesso = false;
			}
			
			echo json_encode($objeto);
			
			
				
		}
		
		public static function excluirAjax() {
			
			$ingresso = new Ingresso();
			$ingresso->selecionarPorId($_POST['id']);
			$resposta = new stdClass();			
			$resposta->sucesso = $ingresso->excluir();

			echo json_encode($resposta);
			
		}
	}