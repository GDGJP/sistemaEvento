<?php

	session_start();
/*	if( $_GET['teste'] == 1 ) {
		$_SESSION['teste'] = 1;
	}
	if( $_GET['teste'] == 1  || $_SESSION['teste'] == 1) {*/
		ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT);
		ini_set('display_errors', 'on');
		require_once __DIR__.'/components/Configuracao.php';
		$controller = (!empty($_GET['controller'])) ? ucwords($_GET['controller']).'Controller' : 'IndexController';
		require_once __DIR__.'/controllers/'.$controller.'.php';
		$view = (!empty($_GET['view'])) ? $_GET['view'] : 'index';
		$controller::$view();
/*	} else {
		echo '<meta charset="utf-8">';
		echo "Você precisa do parametro necessário para acessar esse site";
	}*/
	
?>
