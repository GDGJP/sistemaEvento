<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Usuario.php';
	
	class IndexController extends Controller {
		
		private static $viewController = "index";
		
		public static function index() {
			
			self::$corpo = "index";
			self::renderizar(self::$viewController);
			
		}
		
		public static function login() {
				
			$usuario = new Usuario();
			$aviso = '';

      if(!empty($_SESSION['auth']['id'])) {
        self::$corpo = 'index';
			  self::renderizar(self::$viewController);
      }

			if( !empty($_POST) ) {
				$usuario = $usuario->logar($_POST['email'], $_POST['senha']);
				if( !empty($usuario) ) {
					$_SESSION['auth']['id'] = $usuario->id;
					$_SESSION['auth']['permissao'] = $usuario->tipo;
					self::redirecionar($_SERVER['HTTP_REFERER']);
				} else {
					$aviso = "O par login/senha está incorreto";
				}
			}

			self::$header = 'header_login';
			self::$menu = '';
			self::$variaveis = array('aviso' => $aviso);
			self::$corpo = 'login';
			self::renderizar(self::$viewController);
				
		}
		
		public static function sair() {
			unset($_SESSION['auth']);
			self::redirecionar(Configuracao::$baseUrl);
			
		}
		
	}

?>
