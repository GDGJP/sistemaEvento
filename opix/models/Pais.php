<?php
require_once __DIR__.'/Model.php';

class Pais extends Model{
	
	public $id;
	public $iso;
	public $iso3;
  	public $numcode;
  	public $nome;

	protected $conexao;
	protected static $tabela = "paises";
	
	public function Pais() {
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
