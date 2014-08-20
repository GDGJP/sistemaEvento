<?php
require_once __DIR__.'/Model.php';
	
class TipoUsuario extends Model {
	
	public $id;
	public $nome;
	public $modulos;
	protected $conexao;
	protected static $tabela = "tipos_usuarios";
	
	public function TipoUsuario() {
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
