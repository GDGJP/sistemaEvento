<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';
require_once __DIR__.'/Participante.php';
	
class Cracha extends Model {
	
	public $id;
	public $nome;
	public $foto;
	public $funcao;
	public $fk_participante;
	public $presente;
	public $evento;
	protected $conexao;
	protected static $tabela = "crachas";
	
	public function Cracha() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

	public function listar($condicao = '', $order = '', $limit = '', $select='*') {
		return parent::listar($this, $condicao, $order, $limit,$select);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	public function getParticipante() {
		$participante = new Participante();
		$participante->selecionarPorId($this->fk_participante);
		return $participante;
	}
	
}
