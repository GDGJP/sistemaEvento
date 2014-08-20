<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';

class Boleto extends Model {
	
	public $id;
	public $nossonumero;
	public $cliente;
	public $valor_total;
	public $data_vencimento;
	public $data_pagamento;
	public $valor_pago;
	public $data_processamento;
	protected $conexao;
	protected static $tabela = "boletos";
	
	public function Boleto() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		return parent::excluir($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}

	
}
