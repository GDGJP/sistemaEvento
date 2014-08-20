<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../components/AuthEmail.php';
	require_once __DIR__.'/../components/Listas.php';
	require_once __DIR__.'/../opix/models/Texto.php';
	require_once __DIR__.'/../opix/models/Noticia.php';
	require_once __DIR__.'/../opix/models/Palestrante.php';
	require_once __DIR__.'/../opix/models/Expositor.php';
	require_once __DIR__.'/../opix/models/Profissao.php';
	require_once __DIR__.'/../opix/models/Estado.php';
	require_once __DIR__.'/../opix/models/Participante.php';
	require_once __DIR__.'/../opix/models/Cidade.php';
	require_once __DIR__.'/../opix/models/Estado.php';
	require_once __DIR__.'/../opix/models/Cep.php';
	require_once __DIR__.'/../opix/models/Hotel.php';
	require_once __DIR__.'/../opix/models/Voucher.php';

	class IndexController extends Controller {

		protected static $viewController = "index";

		public static function index() {

			$texto = new Texto();
			$texto->selecionarPorId(1);

			$noticia = new Noticia();
			$noticias = $noticia->listar("destacado = 1", 'id DESC');

			$expositor = new Expositor();
			$expositores = $expositor->listar(null, 'posicao');

			self::$topo = "topo-principal";
			self::$corpo = "index";
			self::$variaveis = array('texto' => $texto, 'noticias' => $noticias, 'expositores' => $expositores);
			self::renderizar(self::$viewController);

		}

		public static function palestrantes() {

		    $texto = new Texto();
		    $texto->selecionarPorId(2);

		    $palestrante = new Palestrante();
		    $palestrantes = $palestrante->listar(null, 'nome');

		    self::$corpo = "palestrantes";
		    self::$variaveis = array('texto' => $texto, 'palestrantes' => $palestrantes);
		    self::renderizar(self::$viewController);

		}

		public static function programacao() {

			$texto = new Texto();
			$texto->selecionarPorId(3);

			$textoTabela = new Texto();
			$textoTabela->selecionarPorId(4);

			self::$corpo = "programacao";
			self::$variaveis = array('texto' => $texto, 'textoTabela' => $textoTabela);
			self::renderizar(self::$viewController);

		}

		public static function expositores() {

			$texto = new Texto();
			$texto->selecionarPorId(5);

			$textoPosicao = new Texto();
			$textoPosicao->selecionarPorId(11);

			$expositor = new Expositor();
			$expositores = $expositor->listar(null, 'posicao');

			self::$corpo = "expositores";
			self::$variaveis = array('texto' => $texto, 'textoPosicao' => $textoPosicao, 'expositores' => $expositores);
			self::renderizar(self::$viewController);

		}

		public static function noticias() {

			$texto = new Texto();
			$texto->selecionarPorId(6);

			$noticia = new Noticia();
			$noticias = $noticia->listar(null, 'id DESC');

			self::$corpo = "noticias";
			self::$variaveis = array('texto' => $texto, 'noticias' => $noticias);
			self::renderizar(self::$viewController);

		}

		public static function noticia() {

			$texto = new Texto();
			$texto->selecionarPorId(6);

			$noticia = new Noticia();
			$noticia->selecionarPorId($_GET['id']);

			$outrasNoticias = $noticia->listar('id <> '.$noticia->id, 'RAND()', 3);

			self::$corpo = "noticia";
			self::$variaveis = array('texto' => $texto, 'noticia' => $noticia, 'outrasNoticias' => $outrasNoticias);
			self::renderizar(self::$viewController);

		}

		public static function local() {

			$texto = new Texto();
			$texto->selecionarPorId(7);

			$textoFotos = new Texto();
			$textoFotos->selecionarPorId(8);

			self::$corpo = "local";
			self::$variaveis = array('texto' => $texto, 'textoFotos' => $textoFotos);
			self::renderizar(self::$viewController);

		}

		public static function hoteis() {

			$texto = new Texto();
			$texto->selecionarPorId(12);

			$hotel = new Hotel();
			$hoteis = $hotel->listar(null, "nome");

			self::$corpo = "hoteis";
			self::$variaveis = array('hoteis' => $hoteis, 'texto' => $texto);
			self::renderizar(self::$viewController);
		}

		public static function contato() {

			if( !empty($_POST) ) {

				$mensagem = "<h2>Dados de contato</h2><br /><br />";
				$mensagem .= "<span><label>Nome: </label> ".$_POST['nome']."</span><br />";
				$mensagem .= "<span><label>E-mail: </label> ".$_POST['email']."</span><br />";
				$mensagem .= "<span><label>Assunto: </label> ".$_POST['assunto']."</span><br />";
				$mensagem .= "<span><label>Mensagem: </label> ".$_POST['mensagem']."</span><br />";


				$email = new AuthEmail();
				$email->enviarEmail('eventos@email.com.br', 'assunto', $mensagem, 'No-Reply');

				self::redirecionar(Configuracao::$baseUrl);
			}

			$texto = new Texto();
			$texto->selecionarPorId(9);

			self::$corpo = "contato";
			self::$variaveis = array('texto' => $texto);
			self::renderizar(self::$viewController);

		}
    /*
    ESTA PARTE PRECISA SER REVISTA PARA CADA SITE
    */
		public static function inscricao() {
			header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: pre-check=0, post-check=0, max-age=0');
			header('Pragma: no-cache');

			if( !empty($_POST) ) {

				$participante = new Participante();

				if( empty($_POST['nome']) ) {
					$erro .= 'nr|';
				}

				if( empty($_POST['email']) ) {
					$erro .= 'er|';
				}

				if( !preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/', $_POST['email']) && !empty($_POST['email']) ) {
					$erro .= 'ei|';
				}

				if( $participante->count('email = \''.$_POST['email'].'\'') > 0 && !empty($_POST['email']) ) {
					$erro .= 'ee|';
				}

				if( empty($_POST['telefone']) ) {
					$erro .= 'tr|';
				}

				if( empty($_POST['data_nascimento']) ) {
					$erro .= 'dnr|';
				}

				if( !empty($_POST['data_nascimento']) ) {
					$data_nascimento = explode("/", $_POST['data_nascimento']);
					if( ($data_nascimento[1] == 2 && $data_nascimento[0] > 29) || ( in_array($data_nascimento[1], array(4, 6, 9, 11)) && $data_nascimento[0] > 30 ) || $data_nascimento[0] > 31 || $data_nascimento[1] > 12 || $data_nascimento[2].$data_nascimento[1].$data_nascimento > date('Ymd') ) {
						$erro .= 'dni|';
					}
				}

				if( empty($_POST['sexo']) ) {
					$erro .= 'sr|';
				}

				if( empty($_POST['cpf']) ) {
					$erro .= 'cr|';
				}

				if( !preg_match('/\d{3}[\.]\d{3}[\.]\d{3}[\-]\d{2}/', $_POST['cpf']) && !empty($_POST['cpf']) ) {
					$erro .= 'ci|';
				}

				if( $participante->count('cpf = \''.$_POST['cpf'].'\'') > 0 && !empty($_POST['cpf']) ) {
					$erro .= 'ce|';
				}

				if( !empty($_POST['cep']) && !preg_match('/\d{5}[\-]\d{3}/', $_POST['cep']) ) {
					$erro .= 'cei|';
				}

				if( !isset($_POST['estado']) || empty($_POST['estado']) ) {
					$erro .= 'esr|';
				}

				if( !isset($_POST['cidade']) || empty($_POST['cidade']) ) {
					$erro .= 'cir|';
				}

				if( !isset($_POST['bairro']) || empty($_POST['bairro']) ) {
					$erro .= 'br|';
				}

				if( !isset($_POST['logradouro']) || empty($_POST['logradouro']) ) {
					$erro .= 'lr|';
				}

				if( !isset($_POST['numero']) || empty($_POST['numero']) ) {
					$erro .= 'nr|';
				}

				if( !empty($_POST['numero']) && !preg_match('/\d+/', $_POST['numero']) ) {
					$erro .= 'ni|';
				}

				if( !isset($_POST['instituicao']) || empty($_POST['instituicao']) ) {
					$erro .= 'ir|';
				}

				if( !isset($_POST['area_atuacao']) || empty($_POST['area_atuacao']) ) {
					$erro .= 'ar|';
				}

				if( !isset($_POST['profissao']) || empty($_POST['profissao']) ) {
					$erro .= 'pr|';
				}

				if( $_POST['profissao'] == 770 && (!isset($_POST['outra_profissao']) || empty($_POST['outra_profissao'])) ) {
					$erro .= 'opr|';
				}

				if( !isset($_POST['grau_instrucao']) || empty($_POST['grau_instrucao']) ) {
					$erro .= 'gir|';
				}

				if( !isset($_POST['tamanho_camisa']) || empty($_POST['tamanho_camisa']) ) {
					$erro .= 'tcr|';
				}

				if( isset($_POST['voucher']) && !empty($_POST['voucher']) ) {  
          //TODO Voucher
          $voucher = new Voucher();
          $listaDeVouchers = $voucher->listar("hash LIKE '".trim($_POST['voucher'])."'");
          if(count($listaDeVouchers)<=0) {
            $erro .= 'vch|';
          }  

          //Testa se ja foi usado
          $voucher2 = new Voucher();
          $listaDeVouchers2 = $voucher2->listar("hash LIKE '".trim($_POST['voucher'])."' AND usado = 0 ");
          if(count($listaDeVouchers2)<=0) {
            $erro .= 'vch2|';
          }  
        }

				if( !empty($erro) ) {
					$_SESSION['dados'] = $_POST;
					if( strpos($_SERVER['HTTP_REFERER'], '?') !== false ) {
						$caminho = explode("?", $_SERVER['HTTP_REFERER']);
						$caminho = $caminho[0];
					} else {
						$caminho = $_SERVER['HTTP_REFERER'];
					}
					header('Location: '.Configuracao::$baseUrl . 'inscricao' . Configuracao::$extensaoPadrao . '?e=' . $erro);
					exit;
				}

				$participante->nome = trim($_POST['nome']);
				$participante->funcao = trim($_POST['funcao']);
				$participante->email = trim($_POST['email']);
				$participante->sexo = trim($_POST['sexo']);
				$participante->data_nascimento = trim($_POST['data_nascimento']);
				$participante->cpf = trim($_POST['cpf']);
				$participante->rg = trim($_POST['rg']);
				$participante->orgao_emissor = trim($_POST['orgao_emissor']);
				$participante->cep = trim($_POST['cep']);
				$participante->telefone = trim($_POST['telefone']);
				$participante->estado = $_POST['estado'];
				$participante->cidade = $_POST['cidade'];
				$participante->bairro = trim($_POST['bairro']);
				$participante->logradouro = trim($_POST['logradouro']);
				$participante->numero = trim($_POST['numero']);
				$participante->profissao = trim($_POST['profissao']);
				$participante->outra_profissao = trim($_POST['outra_profissao']);
				$participante->grau_instrucao = trim($_POST['grau_instrucao']);
				$participante->instituicao = trim($_POST['instituicao']);
				$participante->area_atuacao = trim($_POST['area_atuacao']);
				$participante->tamanho_camisa = trim($_POST['tamanho_camisa']);
        
        if( isset($_POST['voucher']) && !empty($_POST['voucher']) ) {  
          $participante->voucher = $_POST['voucher'];
        }
   
        /*
        TODO BOLETO POR WEBSERVICE
        */
				if( $participante->funcao == 'participante' ) {
					$cURL = curl_init('url do ws');
					curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
					$post = array('post' => array(
							'nome' => $participante->nome,
							'cpf' => $participante->cpf,
							'cep' => $participante->cep,
							'logradouro' => $participante->logradouro,
							'num' => $participante->numero,
							'bairro' => $participante->bairro,
							'cidade' => $participante->getCidade()->nome,
							'estado' => $participante->getEstado()->nome,
							'complemento' => $participante->complemento,
							'voucher' => @$listaDeVouchers[0]->desconto,
							'email' => $participante->email), 1 => 1);
					curl_setopt($cURL, CURLOPT_POST, true);
					curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query($post));
					$resposta = curl_exec($cURL);
					curl_close($cURL);
					$resposta = json_decode($resposta);
					$participante->nossonumero = $resposta->nossonumero;
				}
				if( $participante->salvar() && $participante->funcao == 'participante' ) {

          if( isset($_POST['voucher']) && !empty($_POST['voucher']) ) {  
            $voucher3 = new Voucher();
            $voucher3->selecionarPorId(@$listaDeVouchers[0]->id);
            $voucher3->usado = 1;
            $voucher3->salvar();
          }

					echo '<meta charset="UTF-8">';
					echo "<script>alert('Você cadastrou-se com sucesso!'); document.location.href='".Configuracao::$baseUrl.'confirmacaoCadastro'.Configuracao::$extensaoPadrao.'?nn='.$participante->nossonumero."';</script>";
					exit;
				} else {
					echo '<meta charset="UTF-8">';
					echo "<script>alert('Você cadastrou-se com sucesso!'); document.location.href='".Configuracao::$baseUrl.'confirmacaoCadastro'.Configuracao::$extensaoPadrao."';</script>";
					exit;
				}

			}

			$listaFuncoes = Listas::getFuncao();
			$listaSexos = Listas::getSexo();
			$listaAreasAtuacao = Listas::getAreaAtuacao();
			$listaGrausIntrucao = Listas::getGrauInstrucao();
			$listaTamanhosCamisa = Listas::getTamanhoCamisa();
			$profissao = new Profissao();
			$listaProfissoes = $profissao->listar(null, 'nome');
			$estado = new Estado();
			$listaEstados = $estado->listar(null, 'nome');

			$texto = new Texto();
			$texto->selecionarPorId(10);

			self::$corpo = "inscricao";
			self::$variaveis = array(
				'texto' => $texto,
				'listaFuncoes' => $listaFuncoes,
				'listaSexos' => $listaSexos,
				'listaAreasAtuacao' => $listaAreasAtuacao,
				'listaGrausInstrucao' => $listaGrausIntrucao,
				'listaTamanhosCamisa' => $listaTamanhosCamisa,
				'listaProfissoes' => $listaProfissoes,
				'listaEstados' => $listaEstados
			);
			self::renderizar(self::$viewController);

		}

		public static function confirmaEmail() {

			if( !empty($_REQUEST['value']) ) {
				$email = $_REQUEST['value'];
				$participante  = new Participante();
				$participantes = $participante->listar("email LIKE '".$email."'");
				echo json_encode(array(
					'value' => $_REQUEST['value'],
					'valid' => count($participantes) > 0 ? false : true,
					'message' => 'Email já cadastrado no sistema, escolha outro.'
				));
			} else {
				self::redirecionar(Configuracao::$baseUrl);
			}

		}

    public static function confirmaVoucher() {

			if( !empty($_REQUEST['value']) ) {
				$item = $_REQUEST['value'];
				$participante  = new Participante();
				$participantes = $participante->listar("voucher LIKE '".$item."'");
				echo json_encode(array(
					'value' => $_REQUEST['value'],
					'valid' => count($participantes) > 0 ? false : true,
					'message' => 'Vocher já cadastrado no sistema.'
				));
			} else {
				self::redirecionar(Configuracao::$baseUrl);
			}

		}

		public static function confirmaCpf() {

			if( !empty($_POST) ) {
				$cpf = $_POST['cpf'];
				$participante  = new Participante();
				$participantes = $participante->listar("cpf LIKE '".$cpf."'");
				echo count($participantes) > 0 ? true : false;
			}

		}

		public static function getCidades() {
			if(!empty($_POST['estado'])) {
				$cidade  = new Cidade();
				$cidades = $cidade->listar("estado = ".$_POST['estado']);
				$listaOptions = '<option value="" >Selecione...</option>';
				foreach($cidades AS $cidade) {
					$listaOptions .= '<option value="'.$cidade->id.'" >'.$cidade->nome.'</option>';
				}
				echo $listaOptions;
			}
		}

		public function getInformacoesPorCep() {

			if( !empty($_POST) ) {
				$cep = new Cep();
				$ceps = $cep->listar("cep LIKE '".$_POST['cep']."'");
				if( !empty($ceps) ) {
					$cep = $ceps[0];

					$objeto = new StdClass();
					$objeto->logradouro = $cep->endereco;
					$objeto->bairro = $cep->bairro;
					$objeto->cidade = $cep->cidade;
					$objeto->estado = $cep->estado;
					$objeto->cep = $cep->cep;
					$objeto->resposta = true;
				} else {
					$objeto->resposta = false;
				}

				echo json_encode($objeto);
			}

		}

		public function confirmacaoCadastro() {

			self::$corpo = "confirmacaoCadastro";
			self::renderizar(self::$viewController);

		}
	}
