<?php
require_once __DIR__.'/Model.php';
	
class Link extends Model {
	
	public $id;
	public $titulo;
	public $link;
	protected $conexao;
	protected static $tabela = "links";
	
	public function Link() {
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
