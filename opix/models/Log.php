<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';

class Log extends Model {
	
	public $modulo;
	public $acao;
	public $mensagem;
	public $dataCadastro;
	public $fkUsuario;
	protected $conexao;
	protected static $tabela = "logs";
	
	public function Log() {
		parent::Model();
	}
	
	public function logger( $log ) {
		if( !empty($log) ) {
			return parent::salvar($log);
		} else {
			$lista = parent::listar($this, ' fkUsuario = '.$_SESSION['auth']['id']);
			foreach( $lista as $item ) {
				$item->prepararParaMostrar();
			}
			
			return $lista;
		}
	}
	
	public static function salvarLog($modulo, $acao, $mensagem ) {
		
		$log = new Log();
		$log->modulo = $modulo;
		$log->acao = $acao;
		$log->mensagem = $mensagem;

		if( !empty($_SESSION['auth']['id']) ) {
			$log->fkUsuario =  $_SESSION['auth']['id'];
		}

		$log->logger($log);
		
	}
	
	private function prepararParaMostrar(){
			
		$this->dataCadastro = Funcao::dateFormat($this->dataCadastro);
			
	}
	
}
