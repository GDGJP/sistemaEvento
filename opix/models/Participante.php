<?php
require_once __DIR__.'/Model.php';
require_once __DIR__.'/../components/Funcao.php';
require_once __DIR__.'/Cidade.php';
require_once __DIR__.'/Estado.php';
require_once __DIR__.'/Profissao.php';

class Participante extends Model {

	public $id;
	public $nome;
	public $funcao;
	public $sexo;
	public $data_nascimento;
	public $email;
	public $telefone;
	public $cpf;
	public $rg;
	public $orgao_emissor;
	public $cep;
	public $estado;
	public $cidade;
	public $bairro;
	public $logradouro;
	public $numero;
	public $complemento;
	public $instituicao;
	public $area_atuacao;
	public $profissao;
	public $outra_profissao;
	public $grau_instrucao;
	public $tamanho_camisa;
	public $nossonumero;
	public $pago;
	public $data_pagamento;
	public $dataCadastro;
	public $voucher;
	public $confirmou;
	protected $conexao;
	protected static $tabela = "participantes";

	public function Participante() {
		parent::Model();
	}

	public function salvar() {
		$this->prepararParaGravar();
		return parent::salvar($this);
	}

	public function excluir() {
		return parent::excluir($this);
	}

	public function selecionarPorId( $id ) {
		parent::selecionarPorId($this, $id);
		$this->prepararParaMostrar();
	}

	public function count($condicao = "") {
		try {
			if( !empty($condicao) ) {
				$query = 'SELECT COUNT(*) AS total FROM '.self::$tabela.' WHERE excluido = 0 AND '.$condicao;
			} else {
				$query = 'SELECT COUNT(*) AS total FROM '.self::$tabela.' WHERE excluido = 0';
			}

			$result = $this->conexao->prepare($query);

			$result->execute();

			$resultado = $result->fetch(PDO::FETCH_ASSOC);

			return $resultado['total'];

		} catch (PDOException $e) {
			Conexao::alertaEnviaEmail("<code>" . $e->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	}

	public function listar($condicao = "", $order = "", $limit = "") {
		$lista =  parent::listar($this, $condicao, $order, $limit);
		foreach ($lista as $item) {
			$item->prepararParaMostrar();
		}

		return $lista;
	}

	public function listarPorDia($condicao = "") {

		$result = $this->conexao->prepare('SELECT COUNT(*) AS quantidade, DATE(dataCadastro) AS data FROM participantes WHERE '.$condicao.' GROUP BY DATE(dataCadastro)');
		$result->execute();
		$dadosParticipantes = $result->fetchAll(PDO::FETCH_ASSOC);

		return $dadosParticipantes;

	}

	public function listarPorEstado($formulario) {
		$estado = new Estado();
		$estados = $estado->listar();

		$dadosEstado = array();
		foreach( $estados as $estado ) {
			//$participantes = parent::listar($this, "confirmou = 1 AND respostas LIKE '%\"estado\":\"".$estado->uf."\"%'");
			$participantes = parent::listar($this, "estado = ".$estado->id);
			$dadosEstado[$estado->id]['nome'] = strtoupper($estado->uf);
			$dadosEstado[$estado->id]['quantidade'] = count($participantes);
		}

		return $dadosEstado;
	}

	public function getCidade() {

		if( !empty($this->cidade) ) {

			$cidade = new Cidade();
			$cidade->selecionarPorId($this->cidade);

			return $cidade;
		} else {

			return $this->cidade;

		}

	}

	public function getEstado() {

		if( !empty($this->estado) ) {

			$estado = new Estado();
			$estado->selecionarPorId($this->estado);

			return $estado;
		} else {

			return $this->estado;

		}

	}

	public function getProfissao() {

		if( !empty($this->profissao) ) {

			$profissao = new Profissao();
			$profissao->selecionarPorId($this->profissao);

			return $profissao;
		} else {

			return $this->profissao;

		}

	}

	private function prepararParaMostrar(){
		$this->dataCadastro = Funcao::dateTimeFormat($this->dataCadastro);
		$this->data_nascimento = Funcao::dateFormat($this->data_nascimento);
		$this->data_pagamento = Funcao::dateFormat($this->data_pagamento);
	}

	private function prepararParaGravar(){
		$this->data_nascimento = Funcao::dateFormatToDatabase($this->data_nascimento);
		$this->data_pagamento = Funcao::dateFormatToDatabase($this->data_pagamento);
		$this->dataCadastro = Funcao::dateTimeFormatToDatabase($this->dataCadastro);
	}

}
