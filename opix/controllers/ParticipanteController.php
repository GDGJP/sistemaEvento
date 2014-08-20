<?php
require_once __DIR__.'/Controller.php';
require_once __DIR__.'/../models/Estado.php';
require_once __DIR__.'/../components/AuthEmail.php';
require_once __DIR__.'/../models/Cidade.php';
require_once __DIR__.'/../models/Participante.php';
require_once __DIR__.'/../models/Profissao.php';
require_once __DIR__.'/../models/Cep.php';
require_once __DIR__.'/../components/Listas.php';
require_once __DIR__.'/../models/Voucher.php';

class ParticipanteController extends Controller {

	private static $viewController = "participante";

	public static function listar() {

		$participante = new Participante();
		$totalParticipantesPagos    = $participante->count('pago = 1');
		$totalParticipantesNaoPagos = $participante->count('pago = 0 AND funcao = "participante"');
		$totalParticipantesIsentos  = $participante->count('pago = 0 AND funcao != "participante"');

		$listaDeParticipantes       = $participante->listar();

		$estatisticas = new StdClass();
		$estatisticas->totalMasculino     = 0;
		$estatisticas->totalFeminino      = 0;
		$estatisticas->totalAcademico     = 0;
		$estatisticas->totalGovernamental = 0;
		$estatisticas->totalTerceiroSetor = 0;
		$estatisticas->totalEmpresarial   = 0;
		//IDADES
		$estatisticas->menorQue_20 = 0;
		$estatisticas->entre21_25  = 0;
		$estatisticas->entre26_30  = 0;
		$estatisticas->entre31_40  = 0;
		$estatisticas->entre41_50  = 0;
		$estatisticas->entre51_60  = 0;
		$estatisticas->maiorQue_60 = 0;

		foreach( $listaDeParticipantes as $participante ) {

			$idade = Funcao::calculaIdade($participante->data_nascimento);
			switch($idade) {
				case $idade<=20:
				  $estatisticas->menorQue_20++;
				break;
				case $idade<=25:
				  $estatisticas->entre21_25++;
				break;
				case $idade<=30:
				  $estatisticas->entre26_30++;
				break;
				case $idade<=40:
				  $estatisticas->entre31_40++;
				break;
				case $idade<=50:
				  $estatisticas->entre41_50++;
				break;
				case $idade<=60:
				  $estatisticas->entre51_60++;
				break;
				case $idade>60:
				  $estatisticas->maiorQue_60++;
				break;
			}


			switch( $participante->sexo ) {
				case 'm':
					$estatisticas->totalMasculino++;
				break;
				case 'f':
					$estatisticas->totalFeminino++;
				break;
			}

			@$estatisticas->totalEstados[$participante->estado]++;

			switch( $participante->area_atuacao ) {
				case 'academica':
					$estatisticas->totalAcademico++;
				break;
				case 'governamental':
					$estatisticas->totalGovernamental++;
				break;
				case 'empresarial':
					$estatisticas->totalEmpresarial++;
				break;
				default:
					$estatisticas->totalTerceiroSetor++;
				break;
			}

			$cidades = array();
			$cidades[] = $participante->cidade;
			$estados = array();
			$estados[] = $participante->estado;

		}

		$estados = array_unique($estados);

		$estado = new Estado();

		$estadosFormatados = array();
		foreach ($estados as $idEstado) {
			$estado->selecionarPorId($idEstado);
			$estadosFormatados[$estado->uf] = $estado->id.':'.$estado->uf;
		}

		ksort($estadosFormatados, SORT_REGULAR);
		$estadosFormatados = implode(";", $estadosFormatados);

		$cidades = array_unique($cidades);

		$cidade = new Cidade();

		$cidadesFormatadas = array();
		foreach ($cidades as $idCidade) {
			$cidade->selecionarPorId($idCidade);
			$cidadesFormatadas[$cidade->nome.$cidade->uf] = $cidade->id.':'.addslashes($cidade->nome.' - '.$cidade->uf);
		}

		ksort($cidadesFormatadas, SORT_REGULAR);
		$cidadesFormatadas = implode(";", $cidadesFormatadas);

		self::$variaveis = array('listaDeParticipantes'=>$listaDeParticipantes, 'estatisticas'=>$estatisticas, 'totalPagos'=>$totalParticipantesPagos, 'totalNaoPagos'=>$totalParticipantesNaoPagos, 'totalIsentos' => $totalParticipantesIsentos, 'estadosFormatados' => $estadosFormatados, 'cidadesFormatadas' => $cidadesFormatadas);
		self::$corpo = "listar";

		self::renderizar(self::$viewController);

	}

  public static function listar_nova() {

		$participante = new Participante();
		$totalParticipantesPagos    = $participante->count('pago = 1 AND voucher IS NULL');
		$totalParticipantesNaoPagos = $participante->count('pago = 0 AND funcao = "participante" AND voucher IS NULL');
		$totalParticipantesIsentos  = $participante->count('pago = 0 AND funcao != "participante"');

    $totalParticipantesVouchers = $participante->count(' voucher IS NOT NULL ');

		$listaDeParticipantes       = $participante->listar('',' pago ASC, nossonumero DESC');

    $totalNaoCompareceu  = $participante->count('confirmou = 0');
    $totalCompareceu     = $participante->count('confirmou = 1');

		$estatisticas = new StdClass();
		$estatisticas->totalMasculino     = 0;
		$estatisticas->totalFeminino      = 0;
		$estatisticas->totalAcademico     = 0;
		$estatisticas->totalGovernamental = 0;
		$estatisticas->totalTerceiroSetor = 0;
		$estatisticas->totalEmpresarial   = 0;
		//IDADES
		$estatisticas->menorQue_20 = 0;
		$estatisticas->entre21_25  = 0;
		$estatisticas->entre26_30  = 0;
		$estatisticas->entre31_40  = 0;
		$estatisticas->entre41_50  = 0;
		$estatisticas->entre51_60  = 0;
		$estatisticas->maiorQue_60 = 0;

		foreach( $listaDeParticipantes as $participante ) {

			$idade = Funcao::calculaIdade($participante->data_nascimento);
			switch($idade) {
				case $idade<=20:
				  $estatisticas->menorQue_20++;
				break;
				case $idade<=25:
				  $estatisticas->entre21_25++;
				break;
				case $idade<=30:
				  $estatisticas->entre26_30++;
				break;
				case $idade<=40:
				  $estatisticas->entre31_40++;
				break;
				case $idade<=50:
				  $estatisticas->entre41_50++;
				break;
				case $idade<=60:
				  $estatisticas->entre51_60++;
				break;
				case $idade>60:
				  $estatisticas->maiorQue_60++;
				break;
			}


			switch( $participante->sexo ) {
				case 'm':
					$estatisticas->totalMasculino++;
				break;
				case 'f':
					$estatisticas->totalFeminino++;
				break;
			}

			@$estatisticas->totalEstados[$participante->estado]++;

			switch( $participante->area_atuacao ) {
				case 'academica':
					$estatisticas->totalAcademico++;
				break;
				case 'governamental':
					$estatisticas->totalGovernamental++;
				break;
				case 'empresarial':
					$estatisticas->totalEmpresarial++;
				break;
				default:
					$estatisticas->totalTerceiroSetor++;
				break;
			}

			$cidades = array();
			$cidades[] = $participante->cidade;
			$estados = array();
			$estados[] = $participante->estado;

		}

		$estados = array_unique($estados);

		$estado = new Estado();

		$estadosFormatados = array();
		foreach ($estados as $idEstado) {
			$estado->selecionarPorId($idEstado);
			$estadosFormatados[$estado->uf] = $estado->id.':'.$estado->uf;
		}

		ksort($estadosFormatados, SORT_REGULAR);
		$estadosFormatados = implode(";", $estadosFormatados);

		$cidades = array_unique($cidades);

		$cidade = new Cidade();

		$cidadesFormatadas = array();
		foreach ($cidades as $idCidade) {
			$cidade->selecionarPorId($idCidade);
			$cidadesFormatadas[$cidade->nome.$cidade->uf] = $cidade->id.':'.addslashes($cidade->nome.' - '.$cidade->uf);
		}

		ksort($cidadesFormatadas, SORT_REGULAR);
		$cidadesFormatadas = implode(";", $cidadesFormatadas);

		self::$variaveis = array('listaDeParticipantes'=>$listaDeParticipantes, 
                             'estatisticas'=>$estatisticas, 
                             'totalPagos'=>$totalParticipantesPagos, 
                             'totalNaoPagos'=>$totalParticipantesNaoPagos, 
                             'totalIsentos' => $totalParticipantesIsentos, 
                             'totalVoucher' => $totalParticipantesVouchers, 
                             'estadosFormatados' => $estadosFormatados, 
                             'cidadesFormatadas' => $cidadesFormatadas,
                             'totalCompareceu' => $totalCompareceu,
                             'totalNaoCompareceu' => $totalNaoCompareceu);
		self::$corpo = "listar_nova";


    if($_GET['exportar']==1) {
	    header("Content-type: application/vnd.ms-excel; charset=UTF-8");
	    header("Content-type: application/force-download; charset=UTF-8");
	    header("Content-Disposition: attachment; filename=lista.xls");
	    header("Pragma: no-cache");
	    self::$header = '';
	    self::$topo = '';
	    self::$menu = '';
	    self::$footer = '';
    }

		self::renderizar(self::$viewController);

	}

	public static function confirmar() {

		$participante = new Participante();
		$participante->selecionarPorId($_GET['id']);

		$participante->confirmou = !$participante->confirmou;
		$participante->salvar();

		self::redirecionar(Configuracao::$baseUrl.'participante/listar_nova'.Configuracao::$extensaoPadrao);

	}


	public static function listarGrid() {

		$page = $_GET['page'];
		// get the requested page
		$limit = $_GET['rows'];
		// get how many rows we want to have into the grid
		$sidx = $_GET['sidx'];
		// get index row - i.e. user click to sort
		$sord = $_GET['sord'];
		// get the direction
		if(!$sidx) $sidx =1;
		// connect to the database

		if( $_GET['_search'] === 'true' ) {
			switch( $_GET['searchOper'] ) {
				case 'eq':
					$condicao = $_GET['searchField']." = ".$_GET['searchString'];
				break;
				case 'ne':
					$condicao = $_GET['searchField']." <> ".$_GET['searchString'];
				break;
				case 'bw':
					$condicao = $_GET['searchField']." LIKE '".$_GET['searchString']."%'";
				break;
				case 'bn':
					$condicao = $_GET['searchField']." NOT LIKE '".$_GET['searchString']."%'";
				break;
				case 'ew':
					$condicao = $_GET['searchField']." LIKE '%".$_GET['searchString']."'";
				break;
				case 'en':
					$condicao = $_GET['searchField']." NOT LIKE '%".$_GET['searchString']."'";
				break;
				case 'cn':
					$condicao = $_GET['searchField']." LIKE '%".$_GET['searchString']."%'";
				break;
				case 'nc':
					$condicao = $_GET['searchField']." NOT LIKE '%".$_GET['searchString']."%'";
				break;
				case 'nu':
					$condicao = $_GET['searchField']." IS NULL";
				break;
				case 'nn':
					$condicao = $_GET['searchField']." IS NOT NULL";
				break;
				case 'in':
					$condicao = $_GET['searchField']." IN (".$_GET['searchString'].")";
				break;
				case 'ni':
					$condicao = $_GET['searchField']." NOT IN (".$_GET['searchString'].")";
				break;
			}
		} else {
			$condicao = null;
		}

		$participante = new Participante();
		$count = $participante->count($condicao);

		//$count = 10000000;
		if( $count > 0 ) {
			$total_pages = ceil($count/$limit);
		} else {
			$total_pages = 0;
			$limit = 0;
		}

		if ($page > $total_pages) $page = $total_pages;
		$start = $limit * $page - $limit;

		if( $sidx == "acoes" ) {
			$order = "pago ASC, nossonumero ASC";	
		} else {
			if( $sidx == 'idade' )
				$sidx = 'data_nascimento';
			$order = $sidx." ".$sord;
		}

		$listaDeParticipantes = $participante->listar($condicao, $order, $start.",".$limit);

		$responce = new stdClass();
		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;

		foreach( $listaDeParticipantes as $indice => $participante ) {

			if( $participante->funcao == 'participante' ) {
				if($participante->pago) {
					$botao = '<a id="participante-'.$participante->id.'" title="Desaprovar o pagamento do participante" href="javascript:void(0);" class="btn btn-small btn-success btn-pagar" style="width:35%; margin-right:2%; color:white;">Pago</a>';
				} else {
					$botao = '<a title="enviar boleto ao participante por email" href="javascript:void(0);" id="enviar_'.$participante->id.'" class="btn btn-small" ><i class="btn-icon-only icon-envelope"> enviar boleto</i></a> <a id="participante-'.$participante->id.'" title="Aprovar o pagamento do participante" href="javascript:void(0);" class="btn btn-small btn-danger btn-pagar" style="width:35%; margin-right:2%; color:white;">Não Pago</a>';
				}

        //Com voucher
        if($participante->voucher) {
          $botao = '<a title="Voucher: '.$participante->voucher.'" href="javascript:void(0);" class="btn btn-small btn-info btn-pagar" style="width:35%; margin-right:2%; color:white;" >Voucher</a>';
        }
			} else {
				$botao = '<a id="isento-'.$participante->id.'" title="Participante isento de pagamento" href="javascript:void(0);" class="btn btn-small btn-primary" style="width:35%; margin-right:2%; color:white;">Isento</a>';
			}

			//TODO IDADE
			$idadeParticipante = Funcao::calculaIdade($participante->data_nascimento);

			$responce->rows[$indice]['id'] = $participante->id;
			$responce->rows[$indice]['cell'] = @array($participante->id, $participante->nome, $participante->funcao, $idadeParticipante, $participante->email, $participante->estado?$participante->getEstado()->nome : '---', $participante->cidade?$participante->getCidade()->nome : '---', $botao);
		}

		echo json_encode($responce);

	}

	public static function adicionar() {
		header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: pre-check=0, post-check=0, max-age=0');
		header('Pragma: no-cache');

		if( !empty($_POST) ) {

			$participante = new Participante();
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
        //TODO Voucher
        $voucher = new Voucher();
        $listaDeVouchers = $voucher->listar("hash LIKE '".trim($_POST['voucher'])."'");
        if(count($listaDeVouchers)<=0) {
          echo "N&uacute;mero do Voucher errado.";          
          exit;
        }  

        //Testa se ja foi usado
        $voucher2 = new Voucher();
        $listaDeVouchers2 = $voucher2->listar("hash LIKE '".trim($_POST['voucher'])."' AND usado = 0 ");
        if(count($listaDeVouchers2)<=0) {
          echo "N&uacute;mero do Voucher j&aacute; usado.";          
          exit;
        }

        $participante->voucher = trim($_POST['voucher']);  
      }

			if( $participante->funcao == 'participante' ) {

				$cURL = curl_init('http://www.anid.com.br/aniderp/jsonWsBoleto.php');
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
            'voucher' => $participante->voucher,
						'email' => $participante->email), 1 => 1);
				curl_setopt($cURL, CURLOPT_POST, true);
				curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query($post));
				$resposta = curl_exec($cURL);
				curl_close($cURL);
				$resposta = json_decode($resposta);
				$participante->nossonumero = $resposta->nossonumero;

        

			}
			$participante->salvar();

      if( isset($_POST['voucher']) && !empty($_POST['voucher']) ) {  
        $voucher3 = new Voucher();
        $voucher3->selecionarPorId(@$listaDeVouchers[0]->id);
        $voucher3->usado = 1;
        $voucher3->salvar();
      }

			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

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

		self::$corpo = "adicionar";
		self::$variaveis = array(
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

	public static function editar() {
		header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Cache-Control: pre-check=0, post-check=0, max-age=0');
		header('Pragma: no-cache');

		$participante = new Participante();
		$participante->selecionarPorId($_GET['id']);

		if( !empty($_POST) ) {

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
        //TODO Voucher
        $voucher = new Voucher();
        $listaDeVouchers = $voucher->listar("hash LIKE '".trim($_POST['voucher'])."'");
        if(count($listaDeVouchers)<=0) {
          echo "N&uacute;mero do Voucher errado.";          
          exit;
        }  

        //Testa se ja foi usado
        $voucher2 = new Voucher();
        $listaDeVouchers2 = $voucher2->listar("hash LIKE '".trim($_POST['voucher'])."' AND usado = 0 ");

        if(count($listaDeVouchers2)<=0) {
          echo "N&uacute;mero do Voucher j&aacute; usado.";          
          exit;
        }

        $participante->voucher = trim($_POST['voucher']);  
      }

			if( $participante->funcao == 'participante' && empty($participante->nossonumero) ) {

				$cURL = curl_init('http://www.anid.com.br/aniderp/jsonWsBoleto.php');
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
            'voucher' => $participante->voucher,
						'complemento' => $participante->complemento,
						'email' => $participante->email), 1 => 1);
				curl_setopt($cURL, CURLOPT_POST, true);
				curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query($post));
				$resposta = curl_exec($cURL);
				curl_close($cURL);
				$resposta = json_decode($resposta);
				$participante->nossonumero = $resposta->nossonumero;
			} else {
				$participante->nossonumero = 'NULL';
			}
			
			$participante->salvar();

      if( isset($_POST['voucher']) && !empty($_POST['voucher']) ) {  
        $voucher3 = new Voucher();
        $voucher3->selecionarPorId(@$listaDeVouchers[0]->id);
        $voucher3->usado = 1;
        $voucher3->salvar();
      }

			self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar'.Configuracao::$extensaoPadrao);

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
		$cidade = new Cidade();
		$listaCidades = $cidade->listar('estado = '.$participante->estado, 'nome');

		self::$corpo = "editar";
		self::$variaveis = array(
			'listaFuncoes' => $listaFuncoes,
			'listaSexos' => $listaSexos,
			'listaAreasAtuacao' => $listaAreasAtuacao,
			'listaGrausInstrucao' => $listaGrausIntrucao,
			'listaTamanhosCamisa' => $listaTamanhosCamisa,
			'listaProfissoes' => $listaProfissoes,
			'listaEstados' => $listaEstados,
			'listaCidades' => $listaCidades,
			'participante' => $participante
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

	public static function confirmaCpf() {

		if( !empty($_POST) ) {
			$cpf = $_POST['cpf'];
			$participante  = new Participante();
			$participantes = $participante->listar("cpf LIKE '".$cpf."'");
			echo count($participantes) > 0 ? true : false;
		} else {
			self::redirecionar(Configuracao::$baseUrl);
		}

	}

	public static function getCidades() {
		if(!empty($_POST)) {
			$cidade  = new Cidade();
			$cidades = $cidade->listar("estado = ".$_POST['estado']);
			$listaOptions = '<option value="" >Selecione...</option>';
			foreach($cidades AS $cidade) {
				$listaOptions .= '<option value="'.$cidade->id.'" >'.$cidade->nome.'</option>';
			}
			echo $listaOptions;
		} else {
			self::redirecionar(Configuracao::$baseUrl);
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
		} else {
			self::redirecionar(Configuracao::$baseUrl);
		}

	}

	public static function detalhes() {

		$participante = new Participante();
		$participante->selecionarPorId($_GET['id']);
		$objetoParticipante = $participante;

		self::$variaveis = array('objetoParticipante' => $objetoParticipante);
		self::$corpo = "detalhes";
		self::renderizar(self::$viewController);

	}

	public static function enviarBoleto() {

		$participante = new Participante();
		$participante->selecionarPorId($_POST['id']);
		
		
		$cURL = curl_init('http://www.anid.com.br/aniderp/jsonWsBoleto.php');
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
				'email' => $participante->email,
        'nossonumero' => @$participante->nossonumero), 1 => 1);

		curl_setopt($cURL, CURLOPT_POST, true);
		curl_setopt($cURL, CURLOPT_POSTFIELDS, http_build_query($post));
		$resposta = curl_exec($cURL);
//print_r($resposta);
		curl_close($cURL);
		$resposta = json_decode($resposta);

    if( empty($participante->nossonumero) ) {		
    	$participante->nossonumero = $resposta->nossonumero;
    }

		$mensagem = "<h2>Siga as instruções abaixo</h2><br /><br />";
		$mensagem .= '<a href="http://www.anid.com.br/aniderp/includes/boleto/boleto_bb.php?xxx='.$participante->nossonumero.'" >Clique aqui e visualize o seu boleto para pagamento </a>';


		$email = new AuthEmail();
		$email->enviarEmail($participante->email, 'Boleto de pagamento - 7º Encontro Nacional da Anid', $mensagem, 'No-Reply');
    
    return json_encode(array('nossonumero'=>$participante->nossonumero, 'data_vencimento'=>$resposta->data_vencimento));
	}

	public static function detalhesGrid() {

		$participante = new Participante();
		$participante->selecionarPorId($_POST['id']);
		$objetoParticipante = $participante;

		$grausInstrucao = Listas::getGrauInstrucao();
		$tamanhosCamisa = Listas::getTamanhoCamisa();
		$sexos = Listas::getSexo();
		$areasAtuacao = Listas::getAreaAtuacao();

		$resposta = new StdClass();
		$resposta = $participante;
		$resposta->estado = $participante->getEstado()->nome;
		$resposta->cidade = $participante->getCidade()->nome;
		$resposta->profissao = $participante->getProfissao()->nome;
		$resposta->grau_instrucao = $grausInstrucao[$resposta->grau_instrucao];
		$resposta->sexo = $sexos[$resposta->sexo];
		$resposta->area_atuacao = $areasAtuacao[$resposta->area_atuacao];
		$resposta->tamanho_camisa = $tamanhosCamisa[$resposta->tamanho_camisa];
		$resposta->complemento = !empty($resposta->complemento) ? $resposta->complemento : 'Não Há';
		$resposta->data_cadastro = $participante->dataCadastro;
		unset($resposta->dataCadastro);
		unset($resposta->pago);
		unset($resposta->confirmou);
		unset($resposta->excluido);
		if( !($participante->profissao == 770) && empty($participante->outra_profissao) ) {
			unset($resposta->outra_profissao);
		}
		echo json_encode($resposta);

	}

	public static function imprimirIngresso() {

		$participante = new Participante();
		$participante->selecionarPorHashId($_GET['hash'], $_GET['id']);

		if( !empty($participante) ) {

			$ingresso = new Ingresso();
			$ingresso->selecionarPorId($participante->fkIngresso);

			$evento = new Evento();
			$evento->selecionarPorId($participante->fkEvento);

			$texto = "Ingresso para o evento ".$evento->nome."<br /><br />";
			$texto .= "Código do Ingresso: ".$ingresso->id."<br />";
			$texto .= "Tipo de Ingresso: ".$ingresso->tipoIngresso."<br />";
			$texto .= "Validade do Ingresso: ".$ingresso->dataFim."<br /><br />";
			$texto .= "Data do Evento: ".$evento->dataInicio." até ".$evento->dataFim."<br /><br />";
			$objetoResposta = json_decode($participante->respostas);
			$texto .= "Código do Participante: ".$participante->id.'<br />';
			$texto .= "Nome do Participante: ".$objetoResposta->nome."<br />";

			echo $texto;
			echo "<script>window.print(); window.close();</script>";

		}

	}

	public static function pagar() {

		$participante = new Participante();
		$participante->selecionarPorId($_POST['id']);

		$participante->pago = !$participante->pago;
		$participante->salvar();

	}

	public static function exportar() {

		$participante = new Participante();
		$participantes = $participante->listarPorIdFormulario($_GET['id']);
		$objetosParticipante = array();
		foreach( $participantes as $participante ) {
			$objetosParticipante[] = json_decode($participante->respostas);
		}

		self::$variaveis = array('objetosParticipante' => $objetosParticipante);
		header("Content-type: application/vnd.ms-excel; charset=UTF-8");
		header("Content-type: application/force-download; charset=UTF-8");
		header("Content-Disposition: attachment; filename=listaDeSugestoes.xls");
		header("Pragma: no-cache");
		self::$header = '';
		self::$topo = '';
		self::$menu = '';
		self::$footer = '';
		self::$corpo = "exportar";
		self::renderizar(self::$viewController);

	}

	public static function cpfsDuplicados() {

		if( !empty($_POST) ) {
			$ids = $_POST['ids'];
			foreach( $ids as $id ) {
				$participante = new Participante();
				$participante->selecionarPorId();
				$participante->excluir();
			}
		}

		$participante = new Participante();
		$listaDeParticipantes = $participante->listarParticipantesComCpfsDuplicados($_GET['id']);

		$array = array();
		foreach( $listaDeParticipantes as $participante ) {
			$objetoParticipante = json_decode($participante->respostas);
			if( !empty($objetoParticipante->cpf) ) {
				$array[$objetoParticipante->cpf][] = $participante;
			}
		}

		$listaDeParticipantes = $array;

		self::$variaveis = array('listaDeParticipantes' => $listaDeParticipantes);
		self::$corpo = "cpfsDuplicados";
		self::renderizar(self::$viewController);

	}

	public static function filtros() {
		if( !empty($_POST['tipo']) && !empty($_POST['formulario']) ) {

			$tipo = $_POST['tipo'];
			$formulario = $_POST['formulario'];

			$participante = new Participante();

			switch($tipo) {
				case 'todos' :
					$participantes = $participante->listarPorIdFormulario($formulario);
				break;
				case 'sem-foto' :
					$cracha = new Cracha();
					$crachas = $cracha->listar();
					$idsParticipantes = array();
					foreach( $crachas as $cracha ) {
						$idsParticipantes[] = $cracha->fk_participante;
					}

					$idsParticipantes = implode(", ", $idsParticipantes);

					$participante = new Participante();
					$participantes = $participante->listarPorIdFormulario( $formulario,'id NOT IN ('.$idsParticipantes.')');
				break;
				case 'so-aprovados' :
					$participantes = $participante->listarPorIdFormulario($formulario, 'confirmou = 1');
				break;
				case 'cpfs-invalidos' :
					$participantes = $participante->listarPorIdFormulario($formulario);
					foreach( $participantes as $indice => $participante ) {
						$objetoParticipante = json_decode($participante->respostas);
						if( $objetoParticipante->nacionalidade != 'Brasileiro' || Util::validaCPF($objetoParticipante->cpf) ) {
							unset($participantes[$indice]);
						}
					}
				break;
				case 'so-aprovados-sem-foto' :
					$cracha = new Cracha();
					$crachas = $cracha->listar();
					$idsParticipantes = array();
					foreach( $crachas as $cracha ) {
						$idsParticipantes[] = $cracha->fk_participante;
					}

					$idsParticipantes = implode(", ", $idsParticipantes);

					$participante = new Participante();
					$participantes = $participante->listarPorIdFormulario( $formulario,'id NOT IN ('.$idsParticipantes.') AND confirmou = 1');
				break;
			}

			foreach( $participantes as $participante ) {
				$objetoParticipante = json_decode($participante->respostas);
				$arrayParticipante = get_object_vars($objetoParticipante);
				$arrayParticipante = array_values($arrayParticipante);
				echo '<input type="checkbox" name="participantes[]" value="'.$participante->id.'" />'.$arrayParticipante[3].'&lt;'.$arrayParticipante[7].'&gt;<br />';
			}

		} else {
			echo 'Ocorreu algum erro na solicitação';
		}
	}

}
