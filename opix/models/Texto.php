<?php
require_once __DIR__.'/Model.php';
	
class Texto extends Model {
	
	public $id;
	public $titulo;
	public $texto;
	protected $conexao;
	protected static $tabela = "textos";
	
	public function Texto() {
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
