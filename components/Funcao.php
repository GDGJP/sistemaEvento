<?php
	require_once __DIR__.'/wideimage/WideImage.php';

	class Funcao{

		public static function normatizaVariaveisRespostas( $campo ) {

			return strtolower( preg_replace("/[^A-Za-z0-9_]/", "", utf8_encode(strtr(utf8_decode(trim($campo)), utf8_decode("áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ "), "aaaaeeiooouucAAAAEEIOOOUUC_"))));

		}

		public static function resolveUrlRelativaParaAbsoluta($base, $rel) {
			/* return if already absolute URL */
			if (parse_url($rel, PHP_URL_SCHEME) != '') return $rel;

			/* queries and anchors */
			if ($rel[0]=='#' || $rel[0]=='?') return $base.$rel;

			/* parse base URL and convert to local variables:
			 $scheme, $host, $path */
			extract(parse_url($base));

			/* remove non-directory element from path */
			$path = preg_replace('#/[^/]*$#', '', $path);

			/* destroy path if relative url points to root */
			if ($rel[0] == '/') $path = '';

			/* dirty absolute URL */
			$abs = "$host$path/$rel";

			/* replace '//' or '/./' or '/foo/../' with '/' */
			$re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
			for($n=1; $n>0; $abs=preg_replace($re, '/', $abs, -1, $n)) {}

			/* absolute URL is ready! */
			return $scheme.'://'.$abs;
		}

		public static function substituiCaracteres($string){

			$chars = array('á','à','â','ã','Á','À','Â','Ã','é','ê','É','Ê','í','Í','õ','Õ','ó','ô','Ó','Ô','ú','Ú','ç','Ç');
			$charsNormais = array('a','a','a','a','A','A','A','A','e','e','E','E','i','I','o','O','o','o','O','O','u','U','c','C');

			$string = ucwords(strtolower(str_replace($chars, $charsNormais, $string)));
			return $string;
		}

		public static function prepararLink($string){

			$string = preg_replace("![^a-z0-9]+!i", "-", strtolower($string));
			return $string;
		}

		public static function dateTimeFormat($date){

			if(!empty($date) && strpos($date, "/") === false ){
				$data = explode(' ',$date);
				$x = explode('-', $data[0]);
				$dt = $x[2].'/'.$x[1].'/'.$x[0];

				return $dt.' '.$data[1];
			}
			return '';
		}

		public static function dateTimeFormatToDatabase($date){

			if(!empty($date) && strpos($date, "-") === false ){
				$data = explode(' ',$date);
				$x = explode('/', $data[0]);
				$dt = $x[2].'-'.$x[1].'-'.$x[0];

				return $dt.' '.$data[1];
			}
			return '';
		}

		public static function dateFormat($data){

			if($data != '0000-00-00' && !empty($data) && strpos($data, "/") === false ){
				$x = explode('-', $data);
				$dt = $x[2].'/'.$x[1].'/'.$x[0];

				return $dt;
			}

			return $data;
		}

		public static function dateFormatToDatabase($data){
			if( !empty($data) && strpos($data, "-") === false ){
				$x = explode('/', $data);
				$dt = $x[2].'-'.$x[1].'-'.$x[0];

				return $dt;
			}
			return $data;
		}

		public static function decodificarJsonInterno ( &$teste ) {
			if( strpos($teste, "||") !== false ) {
				$teste = explode("||", $teste);
			}
		}

		public static function pegarValoresCampoEnum($tabela, $campo, $primeiroValor = null, $intersecao = null) {

			$conn = Conexao::getInstance();

			$query = $conn->prepare("SHOW COLUMNS FROM {$tabela} WHERE Field = '{$campo}'");
			$query->execute();
			$linha = $query->fetch(PDO::FETCH_ASSOC);
			$enum = str_replace("enum(", "", $linha['Type']);
			$enum = str_replace("'", "", $enum);
			$enum = substr($enum, 0, strlen($enum) - 1);
			$enum = explode(",", $enum);
			if ($intersecao) {
				foreach ($enum as $chave => $campo) {
					foreach ($intersecao as $retirar) {
						if ($campo == $retirar) {
							unset($enum[$chave]);
						}
					}
				}
			}

			$r = array();

			if ($primeiroValor) {
				$r[''] = $primeiroValor;
			}

			foreach ($enum as $chave => $campo) {
				$campo = trim($campo);
				$r[$campo] = ucwords(str_replace("_", " ", $campo));
			}

			return $r;
		}

		public static function pegarTipoPDO($tabela, $campo) {

			$conn = Conexao::getInstance();

			$query = $conn->prepare("SHOW COLUMNS FROM {$tabela} WHERE Field = '{$campo}'");
			$query->execute();
			$linha = $query->fetch(PDO::FETCH_ASSOC);
			if( strpos($linha['Type'], 'varchar') !== false || strpos($linha['Type'], 'enum') !== false || strpos($linha['Type'], 'text') !== false) {
				return PDO::PARAM_STR;
			} else if( strpos($linha['Type'], 'tinyint(1)') !== false ) {
				return PDO::PARAM_BOOL;
			} else if( strpos($linha['Type'], 'int') !== false ) {
				return PDO::PARAM_INT;
			}

		}

		public static function formataCampoPreco($numero, $forParaBancoDeDados = false) {

			if( $forParaBancoDeDados ) {
				$numero = str_replace(array(',','.'), array('',''), $numero);
				return number_format($numero, 2, '.', ',');
			} else {
				return number_format($numero, 2, ',', '.');
			}

		}

		public static function redimensionarImagem( $file, $largura = '', $altura = '' ) {

			$imagem = WideImage::load($file);
			$imagem->resize($largura, $altura, 'fill')->saveToFile($file);

		}

		public static function gerarNomeImagem( $imagem, $nome ) {
			sleep(2);
			return strtolower(str_replace(" ", "-", $nome)).'-'.md5(date('YmdHis')).'.'.pathinfo($imagem, PATHINFO_EXTENSION);

		}

		

		public static function calculaIdade($data) {

			$arrData = explode('/', $data);
			if(!empty($arrData[1])) {
				error_reporting(0);
				$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
				$nascimento = mktime( 0, 0, 0, $arrData[1], $arrData[0], $arrData[2]);
				$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
				return $idade;
			}
		}

		function geraTimestamp($data) {
			$partes = explode('/', $data);
			return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
		}

		public static function totalDiasEntreDatas($data_inicial, $data_final) {
			// Usa a função criada e pega o timestamp das duas datas:
			$time_inicial = self::geraTimestamp($data_inicial);
			$time_final   = self::geraTimestamp($data_final);

			// Calcula a diferença de segundos entre as duas datas:
			$diferenca = $time_final - $time_inicial; // 19522800 segundos

			// Calcula a diferença de dias
			return $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
		}

		public static function intervaloDeHoraPorMinutos($inicio, $fim, $minuto=10) {

			$tStart = strtotime($inicio);
			$tEnd   = strtotime($fim);
			$tNow   = $tStart;

			while($tNow <= $tEnd){
				$arrTempo[] = date("H:i",$tNow);
				$tNow = strtotime('+'.$minuto.' minutes',$tNow);
			}

			return $arrTempo;

		}

		public static function retornaQuantidadeDeTempoDoIntevalo($inicio, $fim, $minuto=10) {

			$tStart   = strtotime($inicio);
			$tEnd     = strtotime($fim);
			$tNow     = $tStart;
			$contador = 0;
			while($tNow <= $tEnd){
				$contador++;
				$tNow = strtotime('+'.$minuto.' minutes',$tNow);
			}

			return $contador;

		}


		public static function retornaDataIntervalo($dataInicio, $dataFim) {
			$qtdDias = self::totalDiasEntreDatas($dataInicio,$dataFim);
			$arrListaDatas = array($dataInicio);
			if($qtdDias>1) {
				$dataBase = self::dateFormatToDatabase($dataInicio);
				for($i=1;$qtdDias>$i;$i++) {
					$dataSomada = date('d/m/Y', strtotime("+1 days",strtotime($dataBase)));
					array_push($arrListaDatas,$dataSomada);
					$dataBase   = self::dateFormatToDatabase($dataSomada);
				}
			}
			array_push($arrListaDatas,$dataFim);
			return $arrListaDatas;
		}


	}
