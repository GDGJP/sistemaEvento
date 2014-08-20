<?php
require_once __DIR__.'/Model.php';

class ControleAcessoBanners extends Model {

	public $id;
	public $ip;
	public $dadosPessoais;
	public $referer;
	public $banner;
	public $excluido;
	protected $conexao;
	protected static $tabela = "controle_acesso_banners";

	public function ControleAcessoBanners(){
		parent::Model();
	}

	public function salvar() {
		return parent::salvar($this);
	}
	
	public function listar( $condicao = '', $order = '', $limit = '' ) {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

	public function excluir() {
		return parent::excluir($this);

	}

}
