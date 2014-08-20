<?php
require_once __DIR__.'/Model.php';

class Profissao extends Model{
	
	public $id;
	public $nome;
	protected $conexao;
	protected static $tabela = "profissoes";
	
	public function Profissao() {
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
