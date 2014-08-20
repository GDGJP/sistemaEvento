<?php
echo '<pre>';

require_once __DIR__.'/components/Configuracao.php';
require_once __DIR__.'/components/Funcao.php';
require_once __DIR__.'/../components/Util.php';
require_once __DIR__.'/models/Formulario.php';
require_once __DIR__.'/models/Ingresso.php';
require_once __DIR__.'/models/Participante.php';
require_once __DIR__.'/models/Evento.php';
require_once __DIR__.'/models/Passo.php';
require_once __DIR__.'/models/TemplateEmail.php';
session_start('caminhoFormulario');
$_SESSION['url_formulario'] = $_SERVER['HTTP_REFERER'];
$participante = new Participante();

if( !empty($_POST['id_evento']) ) {
	$participante->fkEvento = $_POST['id_evento'];
	unset($_POST['idEvento']);
}

if( !empty($_POST['id_formulario']) ) {
	$participante->fkFormulario = $_POST['id_formulario'];
	unset($_POST['idFormulario']);
}

if(!empty($_POST['passo_ordem'])) {
	$passo = new Passo();
	$passo = $passo->getByFormularioPasso($participante->fkFormulario, $_POST['passo_ordem']);
	unset($_POST['passo_ordem']);
}

$objeto = new stdClass();

//cavalcater[a]gmail[com]
$naoObrigatorios = array('sua_cidade','seu_estado','instituicao','cpf','rgorgao_emissor','passaporte','telefone','paises','cep','logradouro','numero','bairro','cidade','uf','pais','complemento','submit');
//echo "<script> console.error(".print_r($_POST).");</script>";
if($_POST['nacionalidade'][0]=='Brasileiro') {
  $naoObrigatorios = array('sua_cidade','seu_estado','instituicao','passaporte','telefone','paises','cep','logradouro','numero','bairro','pais','complemento','submit');
}
$erros = '';
foreach ($_POST as $nomeCampo => $valor) {
	//cavalcater[a]gmail[com]
  $valor=is_array($valor)?$valor[0]:$valor;
//echo $nomeCampo,'->',$valor, '<hr />'; 
  if( (strpos($valor,'Selecione')!==false || empty($valor)) && !in_array($nomeCampo, $naoObrigatorios) ) {
    $erros .= str_replace('_',' ',$nomeCampo).' ,';
	}
}
//exit;
//cavalcater[a]gmail[com]
if(!empty($erros)) { 
  $_SESSION['formulario']['id'] = $_POST['id_formulario'];
  $_SESSION['formulario']['erros'] = $erros;
  header("Location: erroContato.html");
  exit;     
} else {
  $_SESSION['formulario'] = '';

  foreach ($_POST as $nomeCampo => $valor) {
    if( $nomeCampo == "email" ) {
	    $jaCadastrou = $participante->listarPorIdFormulario($_POST['id_formulario'],"respostas LIKE '%\"email\":\"".$valor."\"%'");
	    if( !empty($jaCadastrou) ) {
		    header("Location: index.html");
		    exit;
	    }
    }

    if( $nomeCampo == "cpf" && $_POST['nacionalidade'][0] == "Brasileiro" ) {
	    $jaCadastrou = $participante->listarPorIdFormulario($_POST['id_formulario'],"respostas LIKE '%\"cpf\":\"".$valor."\"%' AND respostas NOT LIKE '%\"cpf\":\"\"%' ");
	    if( !empty($jaCadastrou) ) {
		    header("Location: index.html");
		    exit;
	    }
	    
	    if( !Util::validaCPF($valor) ) {
	    	echo "<script>alert('Cadastro não ocorreu...');</script>";
			header("Location: index.html");
		    exit;	    
	    }
    }

    if( is_array($valor) ) {
	    $selecao = array();
	    foreach ( $valor as $selecionados ) {
		    $selecao[] = $selecionados;
	    }
	    $valor = implode('||', $selecao);
    }

    $objeto->$nomeCampo = $valor;
  }
  $participante->respostas = json_encode($objeto);
  $idParticipante = $participante->salvar();
  $participante->selecionarPorId($idParticipante);
  if(  $passo->confirmacao  ) {
	  $templateEmail = new TemplateEmail();
	  $templateEmail->selecionarPorId($passo->fkTemplateEmail);


	  $cURL = curl_init(Configuracao::$baseUrl.'templateEmail/enviar/'.$templateEmail->id.'-'.Funcao::prepararLink($templateEmail->nome).Configuracao::$extensaoPadrao);
	  curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	  $post = array('participantes' => array($idParticipante));			 
	  curl_setopt($cURL, CURLOPT_POST, true);
	  curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query($post));
	  $interacao = curl_exec($cURL);
	  curl_close($cURL);

	  echo "<script>window.location.href='".Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../obrigado'.Configuracao::$extensaoPadrao)."';</script>";
  } else {
	  $passos = $passo->listarPorIdFormulario($participante->fkFormulario);
	  if( $participante->passoAtual + 1 <= count($passos) ) {
		  $participante->passoAtual += 1;
		  $participante->salvar();
		  echo "<script>window.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
	  } else {
		  echo "<script>window.location.href='".Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../obrigado'.Configuracao::$extensaoPadrao)."';</script>";
	  }
  }
}
