<?php
require_once __DIR__.'/../conexao/Conexao.php';
require_once __DIR__.'/Log.php';

class Model {
	
	public $excluido;
	protected $conexao;
	
	protected function Model() {
		$this->conexao = Conexao::getInstance();
	}
	
	protected function salvar($model) {
		
		try
		{
		
			$arrayControle = get_object_vars($model);
			unset($arrayControle['conexao']);
			unset($arrayControle['tabela']);
			
			foreach( $arrayControle as $indice => $valor ) {
				if( trim($indice) != '' && !is_null($valor) ) {
					$arrayModel[$indice] = $valor;
				}
			} 
		
			
			$itens = count($arrayModel);
			$controle = 0;
			
			if( empty($model->id) ) {
				$campos = '(';
				foreach($arrayModel AS $indice => $valor) {
					$controle++;
					if( trim($indice) != '' && $indice != 'id' && !is_null($valor) ) {
						$campos .= $indice;
						if($controle < $itens) {
							$campos .= ',';
						}
					}
				}
				$campos .= ')';	
			}
		
			$itens = count($arrayModel);
			$controle = 0;
			
			$query = (!empty($model->id)) ? 'UPDATE '.$model::$tabela.' SET ' : 'INSERT INTO '.$model::$tabela.' '.$campos.' VALUES ( ';
			foreach($arrayModel AS $indice => $valor) {
				$controle++;
				if( trim($indice) != '' && $indice != 'id' && !is_null($valor) ) {
					$query .= (!empty($model->id)) ? $indice.' = :'.$indice : ':'.$indice;
					if($controle < $itens) {
						$query .= ',';
					}
				}
			}
			
			$query .= (!empty($model->id)) ? ' WHERE id = :id' : ' ) ';
			
			$result = $this->conexao->prepare($query);
			
			foreach( $arrayModel as $indice => $valor ) {
				if( !is_null($valor) ) {
					$result->bindParam(":".$indice, $model->$indice, Funcao::pegarTipoPDO($model::$tabela, $indice));
				}
			}
			
			if( !empty($model->id) ) {
				$retorno = $result->execute();
				if( get_class($this) != "Log" ) {
					Log::salvarLog($_GET['controller'], $_GET['view'], 'Foi atualizado o registro '.$model->id);
				}
			} else {
				$result->execute();
				$retorno = $this->conexao->lastInsertId();
				if( get_class($this) != "Log" ) {
					Log::salvarLog($_GET['controller'], $_GET['view'], 'Foi inserido o registro '.$this->conexao->lastInsertId());
				}
			}
			
			return $retorno;
		
		}
		catch (PDOException $e)
		{
		
			echo $e->getMessage(); exit;
			//Conexao::alertaEnviaEmail("<code>" . $e->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
		
	}
	
	protected function excluir( $model ) {
		
		try {
		
			$result = $this->conexao->prepare("UPDATE ".$model::$tabela." SET excluido = :excluido WHERE id = :id");
		
			$result->bindValue(':excluido', !$model->excluido, PDO::PARAM_INT);
			$result->bindValue(':id', $model->id, PDO::PARAM_INT);
				
			Log::salvarLog($_GET['controller'], $_GET['view'], 'Foi excluido o registro '.$this->id);
		
			return $result->execute();
		
		} catch (PDOException $e) {
		
			Conexao::alertaEnviaEmail("<code>" . $e->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		
		}
		
	}
	
	protected function listar($model, $condicao = '', $order = '', $limit = '', $select = "*", $group='') {
	
		try {
			
			if( !empty($condicao) ) {
				$query = 'SELECT '.$select.' FROM '.$model::$tabela.' WHERE excluido = 0 AND '.$condicao.' '.$group;
			} else {
				$query = 'SELECT '.$select.' FROM '.$model::$tabela.' WHERE excluido = 0 '.$group;
			}
			
			if( !empty($order) ) {
				$query .= ' ORDER BY '.$order;
			}
			
			if( !empty($limit) ) {
				$query .= ' LIMIT '.$limit;
			}
//echo $query;
			$result = $this->conexao->prepare($query);
			
			$result->execute();
	
			$linhas = $result->fetchAll(PDO::FETCH_ASSOC);
	
			$objetos = array();
			
			foreach( $linhas as $linha ) {
				$class = get_class($model);
				$objeto = new $class;
				$arrayModel = get_object_vars($model);
				unset($arrayModel['conexao']);
				unset($arrayModel['tabela']);
				
				foreach( $arrayModel as $indice => $valor ) {
					if( isset($linha[$indice]) ) {
						$objeto->$indice = $linha[$indice];
					}
				}
	
				$objetos[] = $objeto;
	
			}
	
			return $objetos;
	
	
		}
		catch (PDOException $e)
		{
			Conexao::alertaEnviaEmail("<code>" . $e->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
			
			//echo $e->getMessage();
		}
	
	}
	
	protected function selecionarPorId( $model, $id ) {
	
		try {
	
			$result = $this->conexao->prepare("SELECT *
										  	   FROM ".$model::$tabela."
										  	   WHERE id = :id");
	
			$result->bindParam(':id', $id, PDO::PARAM_INT);
	
			$result->execute();
	
			$linha = $result->fetch(PDO::FETCH_ASSOC);
			
			$arrayModel = get_object_vars($model);
			foreach( $arrayModel as $indice => $valor ) {
				if( !in_array($indice, array('tabela', 'conexao')) ) {
					$model->$indice = $linha[$indice];
				}
			}
			
		}
		catch (PDOException $e)
		{
			Conexao::alertaEnviaEmail("<code>" . $e->getMessage() . "</code>", $_SERVER['SCRIPT_NAME']);
		}
	
	}
	
}
