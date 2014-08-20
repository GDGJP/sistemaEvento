<?php
	//Esta classe deve ser incluída antes das outras, pois a conexão será trazida nos DAOs
	class Conexao extends PDO {

		private static $instancia;

		public function Conexao($dsn, $username = "", $password = "") {
			// O construtor abaixo é o do PDO
			parent::__construct($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}

		public static function getInstance() {
			// Se o a instancia não existe eu faço uma
			if(!isset( self::$instancia )){
				try {
					self::$instancia = new Conexao("mysql:host=localhost;dbname=nomeBANCO", "root", "123");
				} catch ( Exception $e ) {
					echo 'Erro ao conectar' . $e->getMessage() . ' - ' . $e->getFile() . ' '.$e->getLine();
					exit ();
				}
			}
			// Se já existe instancia na memória eu retorno ela
			self::$instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::$instancia;
		}

		public function alertaEnviaEmail($e, $local) {

			$seu_email = "email";
			$to = 'email';
			$subject = "ERRO NO SISTEMA";
			$message = "<h1>Ocorreu um erro</h1>
						<p><b>Data:</b> ".date('d/m/Y H:i:s')."</p>
						<p><b>Local:</b> ".$local."</p>
						<p><b>Mensagem:</b> ".$e."</p>
						<p><b>Ip:</b> ".$_SERVER['REMOTE_ADDR']."</p>
						<p><b>Link:</b>".$_SERVER['PHP_SELF']."</p>";
			
			$headers = "Content-Type: text/html; charset=UTF-8\n";
			$headers .= "From: $seu_email \n";
			
			mail($to, $subject, $message, $headers);
			print "<script>alert('ERROR: Ocorreu um erro inexperado, e um alerta foi enviado para os responsaveis. Tente novamente mais tarde!'); history.back();</script>";
		}

	}

	//Para obter uma instância da conexão basta digitar Conexao::getInstance(); e atribuir a uma varíavel
	//Por exemplo $con = Conexao::getInstance(); Você verá nos exemplos dos DAO´s

?>
