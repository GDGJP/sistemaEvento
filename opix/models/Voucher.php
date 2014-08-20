<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';
	
class Voucher extends Model {
	
	public $id;
	public $hash;
	public $desconto;
	public $fkEvento;
	public $arquivo;
	public $dataCadastro;
	public $html;
	public $usado;
	public $enviado;
	protected $conexao;
	protected static $tabela = "vouchers";
	
	public function Voucher() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	/*function listarPorIdEvento( $idEvento ) {
		$lista = parent::listar($this,  ' fkEvento = '.$idEvento);
		return $lista;
	}*/
	
  public function listar($condicao = "", $order = "", $limit = "") {
		$lista =  parent::listar($this, $condicao, $order, $limit);

		return $lista;
	}

	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
		//$this->prepararParaMostrar();
	}
	
	public function excluir() {
		parent::excluir($this);
	}
	
}
