<?php
require_once __DIR__.'/Model.php';

class Estado extends Model{
	
	public $id;
	public $uf;
	public $nome;
	public $regiao;
	protected $conexao;
	protected static $tabela = "estado";
	
	public function Estado() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
}
