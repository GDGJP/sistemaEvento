<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';
	
class Agenda extends Model {
	
	public $id;
	public $texto_pt;
	public $texto_en;
	public $link;
	public $cor;
	public $hora_inicial;
	public $hora_final;
	public $dia;
	public $fkSala;
	public $fkEvento;
	protected $conexao;
	protected static $tabela = "agendas";
	
	public function Agenda() {
		parent::Model();
	}
	
	public function salvar() {
	//	$this->prepararParaGravar();
		return parent::salvar($this);
	}
	
	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
	//	$this->prepararParaMostrar();
	}

	function listarPorIdEvento( $idEvento ) {
		return parent::listar($this, ' fkEvento = '.$idEvento);
	}

	function listarPorIdSala( $idSala ) {
		return parent::listar($this, ' fkSala = '.$idSala);
	}

	public function listar($condicao = '', $order = '', $limit = '', $select='*') {
		return parent::listar($this, $condicao, $order, $limit,$select);
	}
	
	public function excluir() {
		parent::excluir($this);
	}

	public function retornaPelaSalaHoraDia($sala, $hora, $dia) {
		return parent::listar($this, "fkSala=".$sala." AND hora_inicial= '".$hora."' AND dia = '".$dia."'", 'hora_inicial ASC');
	}

	public function retornaAgendaPelaHoraDia($hora, $dia) {
		return parent::listar($this, " hora_inicial<= '".$hora."' AND hora_final>= '".$hora."' AND dia = '".$dia."'", 'hora_inicial ASC');
	}
//	private function prepararParaGravar(){
//			
//		$this->dataInicio = Funcao::dateFormatToDatabase($this->dataInicio);
//		$this->dataFim = Funcao::dateFormatToDatabase($this->dataFim);
//			
//	}
//	
//	private function prepararParaMostrar(){
//			
//		$this->dataInicio = Funcao::dateFormat($this->dataInicio);
//		$this->dataFim = Funcao::dateFormat($this->dataFim);
//			
//	}
	
}
