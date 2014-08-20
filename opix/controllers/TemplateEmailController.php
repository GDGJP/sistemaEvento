<?php
require_once __DIR__.'/Controller.php';
require_once __DIR__.'/../models/TemplateEmail.php';
require_once __DIR__.'/../models/Formulario.php';
require_once __DIR__.'/../models/Evento.php';
require_once __DIR__.'/../models/Passo.php';
require_once __DIR__.'/../models/Participante.php';
require_once __DIR__.'/../components/Funcao.php';

class TemplateEmailController extends Controller {

	private static $viewController = "templateEmail";
	
	public static function listar() {
		
		$templateEmail = new TemplateEmail();
		$templatesEmails = $templateEmail->listarPorIdFormulario($_GET['id']);
		
		$formulario = new Formulario();
		$formulario->selecionarPorId($_GET['id']);
		
		self::$variaveis = array('templatesEmails' => $templatesEmails, 'formulario' => $formulario);
		self::$corpo = "listar";
		self::renderizar(self::$viewController);
			
	}
	
	public static function adicionar() {
	
		if( !empty($_POST) ) {
			
			$formulario = new Formulario();
			$formulario->selecionarPorId($_GET['id']);
			
			$templateEmail = new TemplateEmail();
			$templateEmail->nome = $_POST['nome'];
			$templateEmail->assunto = $_POST['assunto'];
			$templateEmail->mensagem = $_POST['mensagem'];
			$templateEmail->fkFormulario = $_GET['id'];
			$templateEmail->fkEvento = $formulario->fkEvento;
			$templateEmail->fkUsuario = $_SESSION['auth']['id'];
			
			$templateEmail->salvar();

			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$templateEmail->fkFormulario.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao);
			
		}
		
		$variaveis = array();
		
		$passo = new Passo();
		$passos = $passo->listarPorIdFormulario($_GET['id']);
		
		foreach( $passos as $unPasso ) {
			if( !empty($unPasso->estrutura) ) {
				$estruturaFormulario =  json_decode(json_decode($unPasso->estrutura)->form_structure);
				foreach( $estruturaFormulario as $campo ) {
					if( is_string($campo->values) ) {
						$variaveis[] = Funcao::normatizaVariaveisRespostas($campo->values);
					}
				}
			}
		}
		
		$variaveis[] = 'linkConfirmacao';
		$variaveis[] = 'linkFinalizacao';
		$variaveis[] = 'linkCertificado';
		
		self::$corpo = "adicionar";
		self::$variaveis = array('variaveis' => $variaveis);
		self::renderizar(self::$viewController);
			
	}
	
	public static function editar() {
	
		$templateEmail = new TemplateEmail();
		$templateEmail->selecionarPorId($_GET['id']);
		
		if( !empty($_POST) ) {
				
			$formulario = new Formulario();
			$formulario->selecionarPorId($templateEmail->fkFormulario);
				
			$templateEmail->nome = $_POST['nome'];
			$templateEmail->assunto = $_POST['assunto'];
			$templateEmail->mensagem = $_POST['mensagem'];
				
			$templateEmail->salvar();
			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$templateEmail->fkFormulario.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao);
				
		}
		
		$variaveis = array();
		
		$passo = new Passo();
		$passos = $passo->listarPorIdFormulario($templateEmail->fkFormulario);
				
		foreach( $passos as $unPasso ) {
			if( !empty($unPasso->estrutura) ) {
				$estruturaFormulario =  json_decode(json_decode($unPasso->estrutura)->form_structure);
				foreach( $estruturaFormulario as $campo ) {
					if( is_string($campo->values) ) {
						$variaveis[] = Funcao::normatizaVariaveisRespostas($campo->values);
					}
				}
			}
		}

		$variaveis[] = 'linkConfirmacao';
		$variaveis[] = 'linkFinalizacao';
		$variaveis[] = 'linkCertificado';
		
		self::$variaveis = array('templateEmail' => $templateEmail, 'variaveis' => $variaveis);
		self::$corpo = "editar";
		self::renderizar(self::$viewController);
			
	}
	
	public static function enviar() {
		
		$templateEmail = new TemplateEmail();
		$templateEmail->selecionarPorId($_GET['id']);
		
		$participante = new Participante();
		$participantes = $participante->listarPorIdFormulario($templateEmail->fkFormulario);
		
		$formulario = new Formulario();
		$formulario->selecionarPorId($templateEmail->fkFormulario);
	
		if( !empty($_POST) ) {
	
			$evento = new Evento();
			$evento->selecionarPorId($templateEmail->fkEvento);
			
			foreach( $_POST['participantes'] as $idParticipante ) {
			
				$participante = new Participante();
				$participante->selecionarPorId($idParticipante);
				$resposta = get_object_vars(json_decode($participante->respostas));
				$variaveisResposta = array_keys($resposta);
				array_walk($variaveisResposta, function(&$valor){ $valor = '[['.$valor.']]'; });
				$mensagemTemplate = str_replace($variaveisResposta, array_values($resposta), $templateEmail->mensagem);
				if( strpos($mensagemTemplate, '[[linkConfirmacao]]') !== false ) {
					$mensagemTemplate = str_replace('[[linkConfirmacao]]', Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../confirmacao.html?h='.md5(date('YmdHis')).base64_encode($idParticipante)), $mensagemTemplate);
				}

				if( strpos($mensagemTemplate, '[[linkFinalizacao]]') !== false ) {
					$mensagemTemplate = str_replace('[[linkFinalizacao]]', Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../inscricoesFoto.html?h='.md5(date('YmdHis')).$idParticipante), $mensagemTemplate);
				}

				if( strpos($mensagemTemplate, '[[linkCertificado]]') !== false ) {
					$mensagemTemplate = str_replace('[[linkCertificado]]', Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../certificacao.html?h='.rawurlencode(base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_256, 'mestresplinter', $idParticipante, MCRYPT_MODE_CFB))).md5(date('YmdHis'))), $mensagemTemplate);
				}
			
				Funcao::enviarEmail($resposta['email'], '=?utf-8?B?'.base64_encode($templateEmail->assunto).'?=', $mensagemTemplate);
			}
			
			self::redirecionar(Configuracao::$baseUrl.'templateEmail/listar/'.$templateEmail->fkFormulario.'-'.Funcao::prepararLink($formulario->nome).Configuracao::$extensaoPadrao);
	
		}
	
		self::$variaveis = array('participantes' => $participantes, 'idFormulario' => $templateEmail->fkFormulario);
		self::$corpo = "enviar";
		self::renderizar(self::$viewController);
			
	}
	
	public static function excluir() {
		
		$templateEmail = new TemplateEmail();
		$templateEmail->selecionarPorId($_POST['id']);
		$templateEmail->excluir();
		
	}
	
}
