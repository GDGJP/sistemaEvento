<?php
	require_once __DIR__.'/opix/models/Participante.php';

	$cURL = curl_init('url ws');
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($cURL, CURLOPT_POST, true);
	curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query(array(1=>1)));
	$resposta = curl_exec($cURL);
	curl_close($cURL);
	$resposta = json_decode($resposta);
	$participante = new Participante();
	foreach( $resposta as $retorno ) {
		$participantes = $participante->listar('nossonumero = '.$retorno->nossonumero);
		if( !empty($participantes) ) {
			$participante = $participantes[0];
			$participante->data_pagamento = $retorno->data_pagamento;
			$participante->pago = 1;
			$participante->salvar();
echo 'ok.'.date('d/m/Y H:i:s').'';
		}
	}
