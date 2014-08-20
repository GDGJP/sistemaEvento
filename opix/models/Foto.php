<?php
require_once __DIR__.'/Model.php';
	
class Foto extends Model {
	
	public $id;
	public $link;
	public $arquivo;
	public $fkPublicidade;
	public $ordem;
	protected $conexao;
	protected static $tabela = "fotos";
	
	public function Foto() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	public function listar($condicao = '', $order = 'ordem', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

}
