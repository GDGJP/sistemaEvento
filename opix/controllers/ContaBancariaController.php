<?php
require_once __DIR__.'/../models/ContaBancaria.php';

class ContaBancariaController {
	
	private static $viewController = "contaBancaria";
	
	public static function editarAjax() {
	
		$contaBancaria = new ContaBancaria();
			
		if( !empty($_POST['id']) ) {
			$contaBancaria->selecionarPorId($_POST['id']);
		} else {
			$contaBancaria->fkUsuario = $_POST['fk_usuario'];
		}
			
		$contaBancaria->banco = $_POST['banco'];
		$contaBancaria->conta = $_POST['conta'];
		$contaBancaria->agencia = $_POST['agencia'];
		$contaBancaria->favorecido = $_POST['favorecido'];
		$contaBancaria->cpfCnpj = $_POST['cpfCnpj'];
		$contaBancaria->contaPrincipal = $_POST['contaPrincipal'];
		$objeto = new stdClass();
			
		$retorno = $contaBancaria->salvar();
			
		if( empty($_POST['id']) ) {
			$objeto->idNovaContaBancaria = $retorno;
		}
			
		if( $retorno ) {
			$objeto->sucesso = true;
		} else {
			$objeto->sucesso = false;
		}
			
		echo json_encode($objeto);

	}
	
	public static function excluirAjax() {
			
		$contaBancaria = new ContaBancaria();
		$contaBancaria->selecionarPorId($_POST['id']);
		$resposta = new stdClass();
		$resposta->sucesso = $contaBancaria->excluir();
	
		echo json_encode($resposta);
			
	}
	
}