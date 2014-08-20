<?php
require_once __DIR__.'/Model.php';

class TemplateEmail extends Model {

	public $id;
	public $nome;
	public $mensagem;
	public $assunto;
	public $status;
	public $fkEvento;
	public $fkFormulario;
	public $fkUsuario;
	public $excluido;
	protected $conexao;
	protected static $tabela = "template_emails";

	public function TemplateEmail(){
		parent::Model();
	}

	public function salvar() {
		return parent::salvar($this);
	}
	
	public function listar( $condicao = '', $order = '', $limit = '' ) {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function listarPorIdEvento( $idEvento ) {
		return parent::listar($this,  'fkEvento = '.$idEvento);
	}
	
	public function listarPorIdFormulario( $idFormulario ) {
		return parent::listar($this,  'fkFormulario = '.$idFormulario);
	}

	public function listarPorIdUsuario( $idUsuario ) {
		return parent::listar($this,  'fkUsuario = '.$idUsuario);
	}

	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

	public function excluir() {
		return parent::excluir($this);

	}

}
