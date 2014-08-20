<?php
require_once __DIR__.'/Controller.php';
require_once __DIR__.'/../models/Formulario.php';
require_once __DIR__.'/../models/TipoFormulario.php';
require_once __DIR__.'/../models/Evento.php';
require_once __DIR__.'/../models/Participante.php';
require_once __DIR__.'/../models/Ingresso.php';
require_once __DIR__.'/../models/Passo.php';
require_once __DIR__.'/../models/TemplateEmail.php';
require_once __DIR__.'/../components/Funcao.php';
require_once __DIR__.'/../formbuilder/Formbuilder/Formbuilder.php';

class FormularioController extends Controller {

	private static $viewController = "formulario";

	public static function listar() {
			
		$formulario = new Formulario();
		$listaDeFormularios = $formulario->listar('fkEvento = '.$_GET['id']);
		
		$evento = new Evento();
		$evento->selecionarPorId($_GET['id']);
		
		self::$variaveis = array('listaDeFormularios' => $listaDeFormularios, 'evento' => $evento);
		self::$corpo = "listar";
		self::renderizar(self::$viewController);
		
	}
	
	public static function editar() {
		
		$formulario = new Formulario();
		$formulario->selecionarPorId($_GET['id']);
		
		$tipoFormulario = new TipoFormulario();
		$tiposFormulario = $tipoFormulario->listar();
		
		$evento = new Evento();
		$evento->selecionarPorId($formulario->fkEvento);
		
		$passo = new Passo();
		$numeroDePassos = count($passo->listarPorIdFormulario($_GET['id']));
	
		if(!empty($_POST)) {
			
			$formulario->nome = $_POST['nome'];
			$formulario->fkTipoFormulario = $_POST['fkTipoFormulario'];
			$formulario->salvar();
			
			$passo = new Passo();
			$numeroDePassos = count($passo->listarPorIdFormulario($formulario->id));
			
			if( $_POST['numeroDePassos'] < $numeroDePassos ) {
			
				for( $i = $_POST['numeroDePassos'] + 1; $i <= 5; $i++ ) {
					$passo = new Passo();
					$passo = $passo->getByFormularioPasso($formulario->id, $i);
					var_dump($passo);
					if( !empty($passo) )
						$passo->excluir();
				}
				
			} else {
				for( $i = 1; $i <= $_POST['numeroDePassos'] - $numeroDePassos; $i++) {
					
					$passo = new Passo();
					$passo->fkFormulario = $formulario->id;
					$passo->ordem = $i + $numeroDePassos;
					$passo->salvar();
					
				}
			}
			
			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
		}
			
		self::$variaveis = array('formulario' => $formulario, 'tiposFormulario' => $tiposFormulario, 'numeroDePassos' => $numeroDePassos);
		self::$corpo = "editar";
		self::renderizar(self::$viewController);
			
	}

	public static function adicionar() {

		$tipoFormulario = new TipoFormulario();
		$tiposFormulario = $tipoFormulario->listar();
		
		if(!empty($_POST)) {
			
			$formulario = new Formulario();
			$formulario->nome = $_POST['nome'];
			$formulario->fkTipoFormulario = $_POST['fkTipoFormulario'];
			$formulario->fkEvento = $_GET['id'];
			$idFormulario = $formulario->salvar();
			
			for( $i = 1; $i <= $_POST['numeroDePassos']; $i++ ) {
				$passo = new Passo();
				$passo->fkFormulario = $idFormulario;
				$passo->ordem = $i;
				$passo->salvar();
			}
			
			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);
			
			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
		}
		
		self::$variaveis = array('tiposFormulario' =>$tiposFormulario);
		self::$corpo = 'adicionar';
		self::renderizar(self::$viewController);
		
	}
	
	public static function montar() {
			
		$formulario = new Formulario();
		$formulario->selecionarPorId($_GET['id']);
		
		$passo = new Passo();
		$objetoPasso = $passo->getByFormularioPasso($_GET['id'], 1);
		$numeroDePassos = count($passo->listarPorIdFormulario($_GET['id']));
		
		$templateEmail = new TemplateEmail();
		$templates = $templateEmail->listar('fkEvento = '.$formulario->fkEvento.' AND fkUsuario = '.$_SESSION['auth']['id']);
		
		self::$variaveis = array('formulario' => $formulario, 'passo' => $objetoPasso,'numeroDePassos' => $numeroDePassos, 'templates' => $templates);
		self::$corpo = "montar";
		self::renderizar(self::$viewController);
			
	}
	
	public static function carregar() {
		
		$objetoNomePadrao = new stdClass();
		$objetoNomePadrao->cssClass = "input_text";
		$objetoNomePadrao->required = "checked";
		$objetoNomePadrao->values = "Nome";
		$objetoEmailPadrao = new stdClass();
		$objetoEmailPadrao->cssClass = "input_text";
		$objetoEmailPadrao->required = "checked";
		$objetoEmailPadrao->values = "Email";
		$formulario = new Formulario();
		$formulario->selecionarPorId($_GET['id']);
		$num_passo = !empty($_GET['passo']) ? $_GET['passo'] : 1;
		$passo = new Passo();
		$passo = $passo->getByFormularioPasso($_GET['id'], $num_passo);
		$objetoEstrutura = json_decode($passo->estrutura);
		if( empty($objetoEstrutura) ) {
			$arrayEstrutura = array();
			array_unshift($arrayEstrutura, $objetoNomePadrao, $objetoEmailPadrao);
			$objetoEstrutura->form_structure = json_encode($arrayEstrutura);
		}
		$form = new Formbuilder((array) $objetoEstrutura);
		$resposta = new stdClass();
		ob_start();
		$form->render_json();
		$json = ob_get_contents();
		$resposta = json_decode($json);
		$resposta->html = $form->generate_html();
		ob_end_clean();
		echo json_encode($resposta);
		
	}
	
	public static function salvar() {
		
		$objetoFormulario = new Formulario();
		$objetoFormulario->selecionarPorId($_GET['id']);
		
		$form = new Formbuilder($_POST);
		$html = $form->generate_html(Configuracao::$baseUrl.'../salvar.html');
		$json = json_encode($form->get_encoded_form_array());
		
		$dom = new DOMDocument('1.0', 'utf-8');
		$dom->loadHTML(mb_convert_encoding($html, 'html-entities', 'utf-8'));
		$formulario = $dom->getElementsByTagName('form')->item(0);
		$ol = $dom->getElementsByTagName('ol')->item(0);
		$inputHidden = $dom->createElement('input');
		$inputHidden->setAttribute('type', 'hidden');
		$inputHidden->setAttribute('name', 'id_evento');
		$inputHidden->setAttribute('value', $objetoFormulario->fkEvento);
		$formulario->insertBefore($inputHidden, $ol);
		//$inputHidden = $dom->createElement('input');
		//$inputHidden->setAttribute('type', 'hidden');
		//$inputHidden->setAttribute('name', 'id_ingresso');
		//$inputHidden->setAttribute('value','$INGRESSO');
		//$formulario->insertBefore($inputHidden, $ol);
		$inputHidden = $dom->createElement('input');
		$inputHidden->setAttribute('type', 'hidden');
		$inputHidden->setAttribute('name', 'id_formulario');
		$inputHidden->setAttribute('value', $_GET['id']);
		$formulario->insertBefore($inputHidden, $ol);
		$inputHidden = $dom->createElement('input');
		$inputHidden->setAttribute('type', 'hidden');
		$inputHidden->setAttribute('name', 'passo_ordem');
		$inputHidden->setAttribute('value', $_GET['passo']);
		$formulario->insertBefore($inputHidden, $ol);
		//$inputHidden = $dom->createElement('input');
		//$inputHidden->setAttribute('type', 'hidden');
		//$inputHidden->setAttribute('name', 'quantidade_ingressos');
		//$inputHidden->setAttribute('value','$QUANTIDADE');
		//$formulario->insertBefore($inputHidden, $ol);
		$html = $formulario->ownerDocument->saveHtml();
		
		$passo = new Passo();
		$passo = $passo->getByFormularioPasso($_GET['id'], $_GET['passo']);
		$passo->html = $html;
		$passo->estrutura = $json;
		$passo->salvar();
		
		$resposta = new stdClass();
		$resposta->html = $html;
		
		echo @json_encode($resposta);
		
	} 
	
	public static function confirmacao() {
	
		if(!empty($_POST)) {
			$passo = new Passo();
			$passo = $passo->getByFormularioPasso($_GET['id'], $_GET['passo']);
			$passo->confirmacao = $_POST['valor'];
			$resposta = new stdClass();
			if( $passo->salvar() ) {
				$resposta->sucesso = true;
			} else {
				$resposta->sucesso = false;
			}
			
			echo json_encode($resposta);
		} else {
			$passo = new Passo();
			$passo = $passo->getByFormularioPasso($_GET['id'], $_GET['passo']);
		
			$checkedSim = ($passo->confirmacao == 1) ? 'checked="checked"' : '';
			$checkedNao = ($passo->confirmacao == 0) ? 'checked="checked"' : '';
		
			echo "<label>Esse passo/fase necessita de confirmação por email?</label>";
			echo "<input type='radio' ".$checkedSim." name='confirmacao' value='1' />Sim ";
			echo "<input type='radio' ".$checkedNao." name='confirmacao' value='0' />Não";
			
		} 
	
	}
	
	public static function salvarTemplate() {
	
		$passo = new Passo();
		$passo = $passo->getByFormularioPasso($_GET['id'], $_GET['passo']);
		$passo->fkTemplateEmail = $_POST['idTemplate'];
		$passo->salvar();
		
		$objeto = new StdClass();
		$objeto->mensagem = "O template de email foi salvo com sucesso";
		echo json_encode($objeto);
	
	}
	
	public static function exportar() {
	
		$formulario = new Formulario();
		$formulario->selecionarPorId($_GET['id']);
		
		$participante = new Participante();
		$participantes = $participante->listarPorIdFormulario($_GET['id']);
		$idsParticipantes = array();
		foreach( $participantes as $participante ) {
			$objetoParticipante = json_decode($participante->respostas);
			$idsParticipantes[] = $objetoParticipante->email;
		}	
		
		$output = implode(", ", $idsParticipantes);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Transfer-Encoding: binary;\n");
		header("Content-Disposition: attachment; filename=\"Emails Participantes Formulario ".$formulario->nome.".txt\";\n");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");
		header("Content-Length: ".strlen($output).";\n");
		echo $output;
		exit;
	}
	
}
