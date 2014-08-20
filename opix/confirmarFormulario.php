<?php
require_once __DIR__.'/components/Configuracao.php';
require_once __DIR__.'/components/Funcao.php';
require_once __DIR__.'/models/Participante.php';
require_once __DIR__.'/models/Passo.php';

$participante = new Participante();
$id = base64_decode(substr($_GET['h'], 32));
$participante->selecionarPorId($id);

if( !empty($participante) ) {
	$passo = new Passo();
	$passos = $passo->listarPorIdFormulario($participante->fkFormulario);
	if( $participante->passoAtual + 1 <= count($passos) ) {
		$participante->passoAtual += 1;
		$participante->salvar();
		echo "<script>alert('Você foi confirmado com sucesso!');window.location.href='".Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../contato.html')."';</script>";
	} else {
		$participante->confirmou = 1;
		$participante->salvar();
		echo "<script>window.location.href='".Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../listaAssinados'.Configuracao::$extensaoPadrao)."';</script>";
	}
} else {
	echo "<script>alert('Ocorreu algum na sua confirmação! Tente novamente...');window.location.href='".Funcao::resolveUrlRelativaParaAbsoluta(Configuracao::$baseUrl, '../')."';</script>";
}
