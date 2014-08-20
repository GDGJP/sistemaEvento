<?php
require_once __DIR__.'/Model.php';

class Expositor extends Model {

	public $id;
	public $nome;
	public $link;
	public $imagem;
	public $posicao;
	protected $conexao;
	protected static $tabela = "expositores";

	public function Expositor() {
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

	public function getUltimaPosicao() {

		$query = $this->conexao->prepare('SELECT MAX(posicao) as ultimaPosicao FROM '.self::$tabela.' WHERE excluido = 0');
		$query->execute();
		$ultimaPosicao = $query->fetchColumn(0);
		return empty($ultimaPosicao) ? 0 : $ultimaPosicao;

	}

}
