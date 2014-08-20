<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/Categoria.php';

class Noticia extends Model {

	public $id;
	public $fkCategoria;
	public $titulo;
	public $resumo;
	public $texto;
	public $imagem;
	public $destacado;
	protected $conexao;
	protected static $tabela = "noticias";

	public function Noticia() {
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

	public function getCategoria() {
		if( !empty($this->fkCategoria) ) {
			$categoria = new Categoria();
			$categoria->selecionarPorId($this->fkCategoria);
			return $categoria;
		} else {
			return $this->fkCategoria;
		}
	}
}
