<?php
require_once __DIR__.'/Model.php';
	
class TipoFormulario extends Model {
	
	public $id;
	public $nome;
	public $certificado;
	public $fkUsuario;
	protected $conexao;
	protected static $tabela = "tipos_formularios";
	
	public function TipoFormulario() {
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
