<?php
require_once __DIR__.'/Model.php';
	
class TipoAgricultura extends Model {
	
	public $id;
	public $nome;
	protected $conexao;
	protected static $tabela = "tipos_agricultura";
	
	public function TipoAgricultura() {
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
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

}
