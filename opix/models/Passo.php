<?php
require_once __DIR__.'/Model.php';

class Passo extends Model{
	
	public $id;
	public $html;
	public $estrutura;
	public $confirmacao;
	public $fkTemplateEmail;
	public $fkFormulario;
	protected $conexao;
	protected static $tabela = "passos";
	
	public function Passo() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	function listarPorIdFormulario( $idFormulario ) {
		return parent::listar($this, ' fkFormulario = '.$idFormulario);
	}
	
	function getByFormularioPasso( $idFormulario, $passo ) {
		$lista = parent::listar($this, ' fkFormulario = '.$idFormulario.' AND ordem = '.$passo);
		return @$lista[0];
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
