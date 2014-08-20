<?php
require_once __DIR__.'/Model.php';
	
class Sala extends Model {
	
	public $id;
	public $nome_pt;
	public $nome_en;
	public $fkEvento;
	protected $conexao;
	protected static $tabela = "salas";
	
	public function Sala() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	

	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}

	function listarPorIdEvento( $idEvento ) {
		return parent::listar($this, ' fkEvento = '.$idEvento);
	}

	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

}
