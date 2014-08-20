<?php
	require_once __DIR__.'/Model.php';

	class Organizador extends Model {
		
		public $id;
		public $nome;
		public $descricao;
		public $fkEvento;
		protected $conexao;
		protected static $tabela = "organizadores";
		
		public function Organizador() {
			parent::Model();
		}
		
		public function salvar() {
			parent::salvar($this);
		}
		
		public function excluir() {
			parent::excluir($this);
		}
		
		public function selecionarPorId( $id ) {
			parent::selecionarPorId($this, $id);
		}
		
		public function listarPorIdEvento( $idEvento ) {
			return parent::listar($this, 'fkEvento = '.$idEvento);
		}
	}
