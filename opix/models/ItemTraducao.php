<?php
require_once __DIR__.'/Model.php';
	
class ItemTraducao extends Model {
	
	public $id;
	public $nome;
	protected $conexao;
	protected static $tabela = "item_traducao";
	
	public function ItemTraducao() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	public function listar() {
		return parent::listar($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

}
