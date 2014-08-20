<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/TipoUsuario.php';
	
class Usuario extends Model {
	
	public $id;
	public $nome;
	public $email;
	public $sexo;
	public $senha;
	public $emailNotificacao;
	public $fkTipoUsuario;
	protected $conexao;
	protected static $tabela = "usuarios";

	public function Usuario() {
		parent::Model();
	}
	
	public function selecionarPorId($id) {
		parent::selecionarPorId($this, $id);
	}
	
	public function logar( $email, $senha ) {
		
		$lista = parent::listar($this,  'email = \''.$email.'\' AND senha =\''.md5($senha).'\'');
		
		return @$lista[0];
	}
	
	public function listar($condicao = '', $order = '', $limit = '') {
		return parent::listar($this, $condicao, $order, $limit);
	}
	
	public function salvar() {
		return parent::salvar($this);
	}
	
	public function verificaLogin( $email ) {
		return parent::listar($this, 'email = \''.$email.'\'') > 0 ? false : true;
	}
	
	public function excluir(){
		return parent::excluir($this);
	}
	
	public function getTipoUsuario() {
		
		if( !empty($this->fkTipoUsuario) ) {
			
			$tipoUsuario = new TipoUsuario();
			$tipoUsuario->selecionarPorId($this->fkTipoUsuario);
			return $tipoUsuario;
			
		} else {
			
			return $this->fkTipoUsuario;
			
		}
		
	}
	
}
