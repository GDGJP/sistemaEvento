<?php
require_once __DIR__.'/Controller.php';
require_once __DIR__.'/../models/Usuario.php';
require_once __DIR__.'/../models/TipoUsuario.php';
require_once __DIR__.'/../models/ContaBancaria.php';

class UsuarioController extends Controller {
	
	private static $viewController = "usuario";
	
	public static function adicionar() {
		
		$tipoUsuario = new TipoUsuario();
		$tiposUsuarios = $tipoUsuario->listar();
		
		if(!empty($_POST)) {
		
			$usuario = new Usuario();
			$usuario->nome = $_POST['nome'];
			$usuario->email = $_POST['email'];
			if( !$usuario->verificaLogin($_POST['email']) ) {
				echo "<script>alert('O Login já existe!'); history.back(-1);</script>";
			}
			$usuario->sexo = $_POST['sexo'];
			$usuario->senha = md5($_POST['senha']);
			$usuario->fkTipoUsuario = $_POST['fkTipoUsuario'];
			$usuario->salvar();
			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);
		}
		
		self::$variaveis = array('tiposUsuarios' => $tiposUsuarios);
		self::$corpo = "adicionar";
		self::renderizar(self::$viewController);
		
	}
	
	public static function editar() {
		
		$usuario = new Usuario();
		$id = !empty($_GET['id']) ? $_GET['id'] : $_SESSION['auth']['id'];
		$usuario->selecionarPorId($id);
		if(!empty($_POST)) {
		
			$usuario->nome = $_POST['nome'];
			$usuario->email = $_POST['email'];
			$usuario->sexo = $_POST['sexo'];
			if( !empty($_POST['senha']) ) $usuario->senha = md5($_POST['senha']);
			$usuario->fkTipoUsuario = $_POST['fkTipoUsuario'];
			$usuario->salvar();
			self::redirecionar(!empty($_GET['id']) ? Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao : Configuracao::$baseUrl);
			
		}
		
		$tipoUsuario = new TipoUsuario();
		$tiposUsuario = $tipoUsuario->listar();
		
		self::$variaveis = array('usuario' => $usuario, 'tiposUsuario' => $tiposUsuario);
		self::$corpo = "editar";
		self::renderizar(self::$viewController);
		
	}
	
	public static function listar() {
	
		$usuario = new Usuario();
		$listaDeUsuarios = $usuario->listar();
		
		self::$variaveis = array('listaDeUsuarios' => $listaDeUsuarios);
		self::$corpo = "listar";
		self::renderizar(self::$viewController);
	
	}
	
	public static function excluir() {
		$usuario = new Usuario();
		$usuario->selecionarPorId($_POST['id']);
		$usuario->excluir();
	}
	
}

?>
