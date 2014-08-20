<?php
require_once __DIR__.'/Model.php';

class Cidade extends Model{
	
	public $id;
	public $nome;
	public $estado;
	public $uf;
	public $capital;
	protected $conexao;
	protected static $tabela = "cidade";
	
	public function Cidade() {
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
