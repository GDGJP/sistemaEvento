<?php
require_once __DIR__.'/Model.php';
	
class AgricultorTipoAgricultura extends Model {
	
	public $id;
	public $fk_agricultor;
	public $fk_tipo_agricultura;
	protected $conexao;
	protected static $tabela = "agricultor_tipo_agricultura";
	
	public function AgricultorTipoAgricultura() {
		parent::Model();
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function excluir() {
		$result = $this->conexao->prepare("DELETE FROM ".self::$tabela." WHERE id = :id");
		$result->bindValue(':id', $this->id, PDO::PARAM_INT);
		return $result->execute();
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	}

}
