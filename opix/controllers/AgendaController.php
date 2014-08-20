<?php
	require_once __DIR__.'/Controller.php';
	require_once __DIR__.'/../models/Agenda.php';
	require_once __DIR__.'/../models/Sala.php';
	require_once __DIR__.'/../models/Evento.php';

	require_once __DIR__.'/../components/Funcao.php';
//	require_once __DIR__.'/../components/dompdf/dompdf_config.inc.php';
	
	class AgendaController extends Controller {
		
		private static $viewController = "agenda";
		
		
		public static function adicionar() {
			$agenda = new Agenda();

			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);

			$sala   = new Sala();
			$salas  = $sala->listar(); 

			$arrListaDatas = Funcao::retornaDataIntervalo($evento->dataInicio, $evento->dataFim);

			$arrHoraInicial = Funcao::intervaloDeHoraPorMinutos('07:00','23:30');	
			$arrHoraFinal   = Funcao::intervaloDeHoraPorMinutos('07:00','23:30');	

			if(!empty($_POST)) {
				$agenda = new Agenda();
				foreach($_POST as $pKey=>$p) {
					if($pKey=='dia') {
						$agenda->$pKey = Funcao::dateFormatToDatabase($p);
					} else {
						$agenda->$pKey = $p;
					}
				}
				$idAgenda = $agenda->salvar();

				$evento = new Evento();
				$evento->selecionarPorId($_POST['fkEvento']);

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
			}

			self::$corpo = "adicionar";
			self::$variaveis = array('salas'=>$salas, 'evento'=>$evento, 'dias'=>$arrListaDatas, 'horaInicial'=>$arrHoraInicial, 'horaFinal'=>$arrHoraFinal);
			self::renderizar(self::$viewController);

		}


		public static function listar() {

			$evento = new Evento();
			$evento->selecionarPorId($_GET['id']);

			$agenda = new Agenda();
			//$lista  = $agenda->listarPorIdEvento($_GET['id']);
			$lista = $agenda->listar('fkEvento = '.$_GET['id'] , 'fkSala ASC, hora_inicial ASC');

			self::$variaveis = array('evento'=>$evento, 'lista' => $lista);
			self::$corpo = "listar";
			self::renderizar(self::$viewController);
			
		}
		

		public static function editar() {
		
			$agenda = new Agenda();
			$agenda->selecionarPorId($_GET['id']);

			$evento = new Evento();
			$evento->selecionarPorId($agenda->fkEvento);

			$sala   = new Sala();
			$salas  = $sala->listar(); 

			$arrListaDatas = Funcao::retornaDataIntervalo($evento->dataInicio, $evento->dataFim);
	
			$arrHoraInicial = Funcao::intervaloDeHoraPorMinutos('07:00','23:30');	
			$arrHoraFinal   = Funcao::intervaloDeHoraPorMinutos('07:00','23:30');	

			if(!empty($_POST)) {
				$agenda = new Agenda();
				foreach($_POST as $pKey=>$p) {
					if($pKey=='dia') {
						$agenda->$pKey = Funcao::dateFormatToDatabase($p);
					} else {
						$agenda->$pKey = $p;
					}
				}
				$idAgenda = $agenda->salvar();

				$evento = new Evento();
				$evento->selecionarPorId($_POST['fkEvento']);

				self::redirecionar(Configuracao::$baseUrl.self::$viewController.'/listar/'.$evento->id.'-'.Funcao::prepararLink($evento->nome).Configuracao::$extensaoPadrao);
			}

			self::$corpo = "editar";
			self::$variaveis = array('agenda'=>$agenda,'salas'=>$salas, 'evento'=>$evento, 'dias'=>$arrListaDatas, 'horaInicial'=>$arrHoraInicial, 'horaFinal'=>$arrHoraFinal);
			self::renderizar(self::$viewController);

				
		}
		
		public static function excluir() {
			
			$voucher = new Agenda();
			$voucher->selecionarPorId($_POST['id']);
			$voucher->excluir();
			
		}

		public static function horasVagas() {

			$sala   = $_POST['sala'];
			$evento = $_POST['evento'];
			$data   = $_POST['data'];
			$data   = Funcao::dateFormatToDatabase($data);			

			$agenda = new Agenda();
			$lista  = $agenda->listar("fkEvento = ".$evento." AND fkSala=".$sala." AND dia = '".$data."'", 'hora_inicial ASC', '', 'hora_inicial, hora_final');
			
			$arrayControleLista = array();
			foreach($lista as $lKey=>$l) {
				$arrLista[$lKey] = Funcao::intervaloDeHoraPorMinutos($l->hora_inicial, $l->hora_final);
				$arrayResultado = array_merge($arrayControleLista, $arrLista[$lKey]);
				$arrayControleLista = $arrayResultado;
			}
			
			$listaCompletaHora = Funcao::intervaloDeHoraPorMinutos('07:00','23:00');

			if(!empty($arrayResultado)) {
				$arrParaUsar = array_diff($listaCompletaHora, $arrayResultado);
			}
		
			if(!empty($arrParaUsar)) {
				foreach($arrParaUsar as $aKey=>$a) {
					@$arrParaUsar['hora'][] = $a;
				}

			} else {
				$arrParaUsar['hora'] = $listaCompletaHora;
			}

			echo json_encode($arrParaUsar['hora']);
		}

		public static function horasVagasSemQuebrarSeguencia() {

//TODO esta item deve pegar o valor separar os arrays e testar retornar apenas oa array em que a hora está


			$sala   = $_POST['sala'];
			$evento = $_POST['evento'];
			$data   = $_POST['data'];
			$data   = Funcao::dateFormatToDatabase($data);			

			$agenda = new Agenda();
			$lista  = $agenda->listar("fkEvento = ".$evento." AND fkSala=".$sala." AND dia = '".$data."'", 'hora_inicial ASC', '', 'hora_inicial, hora_final');
			
			$arrayControleLista = array();
			foreach($lista as $lKey=>$l) {
				$arrLista[$lKey] = Funcao::intervaloDeHoraPorMinutos($l->hora_inicial, $l->hora_final);
				$arrayResultado = array_merge($arrayControleLista, $arrLista[$lKey]);
				$arrayControleLista = $arrayResultado;
			}
			
			$listaCompletaHora = Funcao::intervaloDeHoraPorMinutos('07:00','23:00');

			if(!empty($arrayResultado)) {
				$arrParaUsar = array_diff($listaCompletaHora, $arrayResultado);
			}
		
			if(!empty($arrParaUsar)) {
				foreach($arrParaUsar as $aKey=>$a) {
					@$arrParaUsar['hora'][] = $a;
				}

			} else {
				$arrParaUsar['hora'] = $listaCompletaHora;
			}

			echo json_encode($arrParaUsar['hora']);
		}
	}
