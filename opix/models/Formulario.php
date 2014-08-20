<?php
require_once __DIR__.'/Model.php';

class Formulario extends Model{
	
	public $id;
	public $nome;
	public $fkEvento;
	public $fkTipoFormulario;
	public $fkCertificado;
	protected $conexao;
	protected static $tabela = "formularios";
	
	public function Formulario() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	function listarPorIdEvento( $idEvento ) {
		return parent::listar($this, ' fkEvento = '.$idEvento);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
}
