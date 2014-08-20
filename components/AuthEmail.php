<?php
  
  /*
  MAIL do PEAR
  */

	require_once "Mail.php";
	class AuthEmail {

		private $instanciaSmtp;
		private $contadorServidor;

		private function getInstanciaSmtp() {

			if( empty($this->instanciaSmtp) ) {
				$this->instanciaSmtp = Mail::factory('smtp',
						array ('host' => 'mail.host.com.br',
							'port' => 587,
							'auth' => true,
							'username' => 'noreply@email.com.br',
							'password' => 'senha'));
			}

			return $this->instanciaSmtp;
		}

		public function enviarEmail($para, $assunto, $corpo, $nome) {

			$hnome = "$nome <noreply@email.com.br>";
			$headers = array ('From' => $hnome,
					'To' => $para,
					'Subject' => '=?utf-8?B?'.base64_encode($assunto).'?=',
					'Content-Type' => "text/html; charset=UTF-8");

			$smtp = $this->getInstanciaSmtp();

			$mail = $smtp->send($para, $headers, $corpo);
			if (PEAR::isError($mail)) {
				print "<script>console.error('Ocorreu um erro no envio do email, tente novamente mais tarde.');</script>";
			}

		}

	}
