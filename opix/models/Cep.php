<?php
require_once __DIR__.'/Model.php';

class Cep extends Model{
	
	public $id;
	public $endereco;
	public $bairro;
	public $cidade;
	public $estado;
	public $cep;
	protected $conexao;
	protected static $tabela = "ceps";
	
	public function Cep() {
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
