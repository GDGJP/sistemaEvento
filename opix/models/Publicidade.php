<?php
require_once __DIR__.'/Model.php';
	
class Publicidade extends Model {
	
	public $id;
	public $nome;
	public $fkUsuario;
	protected $conexao;
	protected static $tabela = "publicidades";
	
	public function Publicidade() {
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
