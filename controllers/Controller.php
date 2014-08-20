<?php
	class Controller {
		
		protected static $header = "header";
		protected static $topo = "topo";
		protected static $menu = "menu";
		protected static $social = "social";
		protected static $corpo = "index";
		protected static $footer = "footer";
		protected static $variaveis = array();
		
		protected function renderizar( $viewController ) {
			
			if( !empty(self::$header) ) include __DIR__.'/../views/layout/'.self::$header.'.php';
			if( !empty(self::$menu) ) include __DIR__.'/../views/layout/'.self::$menu.'.php';
			if( !empty(self::$topo) ) include __DIR__.'/../views/layout/'.self::$topo.'.php';
			if( !empty(self::$social) ) include __DIR__.'/../views/layout/'.self::$social.'.php';
			foreach( self::$variaveis as $nomeVariavel => $valorVariavel ) {
				$$nomeVariavel = $valorVariavel;
			}
			if( !empty(self::$corpo) ) include __DIR__.'/../views/'.$viewController.'/'.self::$corpo.'.php';
			if( !empty(self::$footer) ) include __DIR__.'/../views/layout/'.self::$footer.'.php';
			exit;
		}
		
		protected function redirecionar( $caminho ) {

			header("Location: ".$caminho);
			
		}
		
	}
?>