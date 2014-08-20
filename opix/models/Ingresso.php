<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';

class Ingresso extends Model {
	
	public $id;
	public $tipoIngresso;
	public $preco;
	public $quantidade;
	public $descricao;
	public $dataInicio;
	public $dataFim;
	public $restrito;
	public $fkEvento;
	protected $conexao;
	protected static $tabela = "ingressos";
	
	public function Ingresso() {
		parent::Model();
	}
	
	public function salvar() {
		$this->prepararParaGravar();
		parent::salvar($this);
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
		$this->prepararParaMostrar();
	}
	
	function listarPorIdEvento( $idEvento ) {
		$lista = parent::listar($this,  'fkEvento = '.$idEvento);
		foreach( $lista as $item ) {
			$item->prepararParaMostrar();
		}
		
		return $lista;
	}
	
	private function prepararParaGravar(){
		
		$this->dataInicio = Funcao::dateFormatToDatabase($this->dataInicio);
		$this->dataFim = Funcao::dateFormatToDatabase($this->dataFim);
		$this->preco = Funcao::formataCampoPreco($this->preco, true);
		
	}
	
	private function prepararParaMostrar(){
		
		$this->dataInicio = Funcao::dateFormat($this->dataInicio);
		$this->dataFim = Funcao::dateFormat($this->dataFim);
		$this->preco = Funcao::formataCampoPreco($this->preco);
		
	}
	
}
