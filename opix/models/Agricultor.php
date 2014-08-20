<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/AgricultorTipoAgricultura.php';
	
class Agricultor extends Model {
	
	public $id;
	public $nome;
	public $telefone;
	public $cpf;
	protected $conexao;
	protected static $tabela = "agricultores";
	
	public function Agricultor() {
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

	public function getTiposAgricultura() {
		if( !empty($this->id) ) {
			$agricultorTipoAgricultura = new AgricultorTipoAgricultura();
			return $agricultorTipoAgricultura->listar('fk_agricultor = '.$this->id);
		} else {
			return array();
		}
	}

}
