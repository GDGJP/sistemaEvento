<?php
require_once __DIR__.'/Model.php';

class Certificado extends Model{
	
	public $id;
	public $nome;
	public $texto;
	public $fkEvento;
	protected $conexao;
	protected static $tabela = "certificados";
	
	public function Certificado() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	function listarPorIdEvento( $idEvento ) {
		return parent::listar($this, ' fkEvento = '.$idEvento);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
}
