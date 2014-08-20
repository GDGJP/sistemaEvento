<?php
	session_start();
	ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);
	ini_set('display_errors', 'on');
	require_once __DIR__.'/components/Configuracao.php';
	$controller = (!empty($_GET['controller'])) ? ucwords($_GET['controller']).'Controller' : 'IndexController';
	require_once __DIR__.'/controllers/'.$controller.'.php';
	$view = (!empty($_GET['view'])) ? $_GET['view'] : 'index';
	if( !empty($_SESSION['auth']['id']) ) {
		require_once __DIR__.'/models/Usuario.php';
		$usuario = new Usuario();
		$usuario->selecionarPorId($_SESSION['auth']['id']);		
		$controller::$view();
	} else if( $controller == "TemplateEmailController" && $view == "enviar" && !empty($_POST['participantes']) ) {
		require_once __DIR__.'/controllers/IndexController.php';
		$controller::$view();
	}  else {
		require_once __DIR__.'/controllers/IndexController.php';
		IndexController::login();
	}
?>
