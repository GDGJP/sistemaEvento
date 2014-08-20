<?php
require_once __DIR__.'/Model.php';

class Painel extends Model {
	
	public $id;
	public $nome;
	public $imagem;
	public $fkUsuario;
	public $lang;
	protected $conexao;
	protected static $tabela = "painel";
	
	public function Painel() {
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
