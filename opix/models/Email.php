<?php
require_once __DIR__.'/Model.php';
	
class Email extends Model {
	
	public $id;
	public $email;
	public $enviado;
	public $dataEnvio;
	protected $conexao;
	protected static $tabela = "lista_emails";
	
	public function Email() {
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
