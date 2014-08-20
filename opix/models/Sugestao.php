<?php
require_once __DIR__.'/Model.php';
	
class Sugestao extends Model {
	
	public $id;
	public $nome;
	public $email;
	public $setor;
	public $endereco;
	public $uf;
	public $titulo_tema;
	public $justificativa;
	public $status;
	protected $conexao;
	protected static $tabela = "sugestoes";
	
	public function Sugestao() {
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
