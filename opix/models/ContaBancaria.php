<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';

class ContaBancaria extends Model {
	
	public $id;
	public $banco;
	public $agencia;
	public $conta;
	public $favorecido;
	public $cpfCnpj;
	public $contaPrincipal;
	public $fkUsuario;
	protected $conexao;
	protected static $tabela = "contas_bancarias";
	
	public function ContaBancaria(){
		parent::Model();
	}
	
	public function salvar() {
		$this->prepararParaGravar();
		return parent::salvar($this);
	}
	
	function listarPorIdUsuario( $idUsuario ) {
		$lista = parent::listar($this,  'fkUsuario = '.$idUsuario);
		foreach ( $lista as $item ) {
			$item->prepararParaMostrar();
		}
		
		return $lista;
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
		$this->prepararParaMostrar();
	}
	
	public function excluir() {
		return parent::excluir($this);
	}
	
	private function prepararParaGravar(){
	
		$this->banco = strtolower(str_replace(" ", "_", $this->banco));
	
	}
	
	private function prepararParaMostrar(){
	
		$this->banco = ucwords(str_replace("_", " ", $this->banco));
	
	}
	
}
