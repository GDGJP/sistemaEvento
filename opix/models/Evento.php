<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';
	
class Evento extends Model {
	
	public $id;
	public $nome;
	public $imagem;
	public $dataInicio;
	public $dataFim;
	public $categoria;
	public $programacao;
	public $privado;
	public $local;
	public $cep;
	public $endereco;
	public $numero;
	public $complemento;
	public $bairro;
	public $cidade;
	public $estado;
	public $fkUsuario;
	protected $conexao;
	protected static $tabela = "eventos";
	
	public function Evento() {
		parent::Model();
	}
	
	public function salvar() {
		$this->prepararParaGravar();
		return parent::salvar($this);
	}
	
	function listarPorIdUsuario( $idUsuario ) {
		$lista = parent::listar($this,  ' fkUsuario = '.$idUsuario);
		foreach( $lista as $item ) {
			$item->prepararParaMostrar();
		}
		
		return $lista;
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
		$this->prepararParaMostrar();
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
	private function prepararParaGravar(){
			
		$this->dataInicio = Funcao::dateFormatToDatabase($this->dataInicio);
		$this->dataFim = Funcao::dateFormatToDatabase($this->dataFim);
			
	}
	
	private function prepararParaMostrar(){
			
		$this->dataInicio = Funcao::dateFormat($this->dataInicio);
		$this->dataFim = Funcao::dateFormat($this->dataFim);
			
	}
	
}
